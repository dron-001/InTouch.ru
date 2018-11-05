<?


session_start();

  /*****************************/
 /************Бан IP***********/
/*****************************/

$handle = @fopen('ban.txt', 'r');
if($handle){
    
    while (($buffer = fgets($handle, 4096)) !== false){
        
        if(trim($buffer) == $_SERVER['REMOTE_ADDR'])
            exit('Доступ с этого IP запрещён');
    }
    
    if(!feof($handle)){
        echo 'Error: unexpected fgetc() fail';
    }
    
    fclose($handle);
}



$CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
if( !CONNECT ) exit('MySQL error');



  /*****************************/
 /*********Рефералы************/
/*****************************/

if( is_numeric($_GET['ref']) ){
    
    setcookie('ref', $_GET['ref'], strtotime('+1 week') );
    header('location: /home');
}




    
    

  /*********************************/
 /*Переброс на login.php при входе*/
/*********************************/

if ( $_SERVER['REQUEST_URI'] == '/' ) $page = 'login';
else {
  /*****************************/
 /**Валидация адресной строки**/
/*****************************/
   $pag = parse_url($_SERVER['REQUEST_URI']);
   $page = substr($pag[path], 1);
    //$dom = explode('/', $_SERVER['REQUEST_URI']);
    //$page = $dom[1];
    //$modul = $dom[2];
    //$param = $dom[3];
    
    
    
    
    
   /* if($modul == 'id' and $q == 1){
        $_SESSION['iduser'] = $param;
        header('location: /user');
        
        
    }*/
        
	//if ( !preg_match('/^[A-z0-9]{3,15}$/', $page) ) not_found();
}

  /**************************************/
 /*Поиск юзера по ip по адресной строке*/
/**************************************/

if( $page == 'user'  and !is_numeric($_GET[id])) not_found();
$q = mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `id` = '$_GET[id]'"));
if ( $_GET[id] and $q != 1) not_found();




  /*****************************************/
 /**Переход на страниццу если она найдена**/
/*****************************************/

if ( file_exists('all/'.$page.'.php') ) include 'all/'.$page.'.php';

else if ( $_SESSION['id'] and file_exists('auth/'.$page.'.php') ) include 'auth/'.$page.'.php';

else if ( !$_SESSION['id'] and file_exists('guest/'.$page.'.php') ) include 'guest/'.$page.'.php';

else if ( $_SESSION['admin'] and file_exists('admin/'.$page.'.php') ) include 'admin/'.$page.'.php';

else not_found();





  /***************************************************************************************************************************************************/
 /**********************************************Функции необходимые для работы сайта*****************************************************************/
/***************************************************************************************************************************************************/




function issecurity($avatar){
    $sz = getimagesize($avatar["tmp_name"]);
    
    if($sz[0] < 150 or $sz[1] < 150){
        echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                Минимальный размер изоброжения 150*150.
                </div>';
                exit();
    }
    $name = $avatar['name'];
    $type = $avatar['type'];
    $size = $avatar['size'];
    $blacklist = array('.php', 'phtml', 'php3', 'php4');
    foreach($blacklist as $item){
        if(preg_match("/$item\$/i", $name)) return false;
        
        
    }
    if( $type != "image/gif" and $type != "image/png" and $type != "image/jpg" and $type != "image/jpeg") return false;
    if($size > 5 * 1024 * 1024) return false;
    
    return true;
    
    
    
}
function issecurity_mp3($audio){
    
    $type = $audio['type'];
    
   include('getMP3info.php');

 
  if( $type != "audio/mp3"  and $type != "audio/ogg") return false;
 $info = getMP3data($audio['tmp_name']);
 $name = $info['id3v1']['name'];
 
    
    
   
    
    $size = $info['id3v2']['size'];
    $blacklist = array('.php', 'phtml', 'php3', 'php4');
    foreach($blacklist as $item){
        if(preg_match("/$item\$/i", $name)) return false;
        
        
    }
    if( $type != "audio/mp3"  and $type != "audio/ogg") return false;
    if($size > 30 * 1024 * 1024) return false;
    
    return true;
    
    
    
}
function load_audio($audio, $id){
    
    
 
    $info = getMP3data($audio['tmp_name']);
 
    $type = $audio['type'];
    $uploaddir = "media/audio_users/";
    $name = md5(microtime()).".".substr($type, strlen("audio/"));
    $uploadfile = $uploaddir.$name;
    if(move_uploaded_file($audio["tmp_name"], $uploadfile)){
        
         save_audio($name, $info);
        
        return true;
    }
    else return false;
    
    
}
function save_audio($name, $info){
    
    $size = $info['id3v2']['size'];
    $year = $info['id3v1']['year'];
    $time = $info ["duration_str"];
    $album =$info['id3v1']['album'];
    $artists = $info['id3v1']['artists'];
    
    
    
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    mysqli_query($CONNECT, 'INSERT INTO `audio` VALUES ("", "'.$name.'", "'.$artists.'", "", "'.$album.'", "'.$time.'", "'.$year.'", "'.$size.'")');
}
function loadAvatar($avatar, $id){
    $type = $avatar['type'];
    $name = 'avatars/'.md5(microtime()).".".substr($type, strlen("image/"));
    if(move_uploaded_file($avatar["tmp_name"], $name)){
        setAvatar($_SESSION[id], $name);
        
        return true;
    }
    else return false;
    
    
    
}

function loadAphoto($avatar){
    $type = $avatar['type'];
    $uploaddir = "photo/photo_users/";
    $name = md5(microtime()).".".substr($type, strlen("image/"));
    $uploadfile = $uploaddir.$name;
    if(move_uploaded_file($avatar["tmp_name"], $uploadfile)){
        
        save_photo( $uploadfile, $name);
        save_photo_on_user( $_SESSION[id], $name);
        
        return true;
        
    }
    else return false;
    
}

function go_idphoto_on_namephoto( $namephoto ){
    
     $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $photo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id_photo` FROM `photo` WHERE `name_photo` = '$namephoto'"));
    
    
    return $photo['id_photo'];
    
    
}
function save_photo( $photo, $name){
    
    $s = getimagesize($photo);
    
    
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    mysqli_query($CONNECT, 'INSERT INTO `photo` VALUES ("", "'.$name.'", "'.$s[0].'", "", "'.$s[1].'")');
    
}

function save_photo_on_user( $id_user, $name_photo){
    
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $n = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `photo` WHERE `name_photo` = '$name_photo'"));
    $id_photo = $n['id_photo'];
   
    
    mysqli_query($CONNECT, 'INSERT INTO `photo_users` VALUES ("'.$id_user.'", "'.$id_photo.'" )');
}

function setAvatar($id, $name){
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
     mysqli_query($CONNECT, "UPDATE `users` SET `avatar` = '$name' WHERE `id` = '$id'");
    

    
    
    
}

function message( $text ) {
	exit('{ "message" : "'.$text.'"}');
}

function work(){
    if( !in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1')) )
        exit('На данной странице ведутся технические работы ');
    
}

function go( $url ) {
	exit('{ "go" : "'.$url.'"}');
}



function random_str( $num = 30 ) {
	return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $num);
}




function captcha_show() {

	$questions = array(
		1 => 'Столица России ?',
		2 => 'Столица Украины ?',
		3 => 'Столица США ?',
		4 => 'Имя короля поп музыки ?',
		5 => 'Разработчки GTA 5 ?',
		);

	$num = mt_rand(1, count($questions) );
	$_SESSION['captcha'] = $num;

	echo $questions[$num];

}

function not_found(){
    exit('not_found');
}



function captcha_valid() {

	$answers = array(
		1 => 'моска',
		2 => 'киев',
		3 => 'вашингтон',
		4 => 'майкл',
		5 => 'RockStarGames',
		);

if ( $_SESSION['captcha'] != array_search( strtolower($_POST['captcha']), $answers) )
	message('Ответ на вопрос указан неверно');
 
}

function services_price( $id ){
    
    $arr = array(
    1 => 10,
    2 => 50,
    3 => 200,
    );
    
    return $arr[$id];
}

function calbc_promo($id){
    if($_SESSION['promo']) $promo = $_SESSION['promo'];
    else $promo = 0;
    
    $per =  (services_price($id) * $promo)  / 100;
    return (services_price($id) - $per);
}

function services_promo( $code ){
    
    $arr = array(
    'qwerty' => 10,
    'asdfgh' => 50,
    'zxcvbn' => 70,
    );
    
    return $arr[$code];
}

/*function number_valid(){
    $_POST['email'] = preg_replace('/\|\+|\(|\)/','', $_POST['email']);
    if(!is_numeric($number)){
        message('Неправильный номер');
        
        if(strlen($_POST['email']) < 5)
        message('Номер слишком короткий');
    
    
}*/
function get_mess($id_sabs){
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $n = mysqli_query($CONNECT, "SELECT `from_id` FROM `messages` WHERE `status` = 0 and `to_id` = '$_SESSION[id]' and `from_id` = $id_sabs");
    
    while( $w = mysqli_fetch_assoc($n) ){
        
        $m += 1;
        
        
    }
    
    return $m;
    
}
function new_message( $id_user ){
    
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $n = mysqli_query($CONNECT, "SELECT `from_id` FROM `messages` WHERE `status` = 0 and `to_id` = '$_SESSION[id]'");
    
    
    $mas = array();
    
    
    while( $w = mysqli_fetch_assoc($n) ){
        
        $q = $w[from_id];
        
        $mas[] = $q;
        
        
    }
    
    
    
    $count = count($mas);
    
    for($i = 0; $i < $count; $i++){
        for($e = $i; $e > 0; $e--){
            
            if( $mas[$e] == $mas[$e-1]){
            $mas[$e-1] = 0;
            
            
            }
            
            
        }
        
        
        
       
    }
    asort($mas);
    
    
    
    
    for($i = 0; $i < $count; $i++){
        
        
        if($mas[$i] == 0){
            
            array_shift($mas);
           
             
        }
        
    }
   $W = count($mas);
    
     
    
    return $W;
    
    
    
    
    
    
}

function email_valid() {
    $number = preg_replace('/\|\+|\(|\)/','', $_POST['email']);
    if(is_numeric($number)){
        //если номер
        $_POST['email'] = preg_replace('/\|\+|\(|\)/','', $_POST['email']);
        if(strlen($_POST['email']) < 5)
        message('Номер слишком короткий');
    }
	else if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL))
		message('E-mail указан неверно');
}

function go_name_on_id( $id ){
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $name = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `name` FROM `users` WHERE `id` = '$id'"));
    
    return $name['name'];
    
    
}

function show_seach(){
    global $page;
    
    echo ' <form method = "POST" action = "'.$page.'"><input style="width: 170px;" type = "text" placeholder = "Поиск" name = "seach" ><button name="enter" type="submit" value="Искать">Искать</button></form>';
    
}
    

 
function getavatar($id){
    
     $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $avatar = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `avatar` FROM `users` WHERE `id` = '$id'"));
    if($avatar['avatar'] == "") $avatar['avatar'] = 'default.jpg';
    return($avatar['avatar']);
    
    
}

function go_name_photo_on_id($id_photo){
    
    $CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    $photo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `name_photo` FROM `photo` WHERE `id_photo` = '$id_photo'"));

    return($photo['name_photo']);
}


function password_valid() {
	if ( !preg_match('/^[A-z0-9]{9,30}$/', $_POST['password']) )
		message('Пароль указан неверно и может содеражть 10 - 30 символов A-z0-9');
	$_POST['password'] = md5($_POST['password']);
}
function name_valid(){
    if ( !preg_match('/^[A-z]{3,10}$/', $_POST['name']) )
		message('Имя может содеражть 13 - 10 символов A-z');
	
}
function surname_valid(){
    if ( !preg_match('/^[A-z]{3,10}$/', $_POST['surname']) )
		message('Фамилия может содеражть 13 - 10 символов A-z');
	
}

function patronymic_valid(){
    if ( !preg_match('/^[A-z]{3,15}$/', $_POST['patronymic']) )
		message('Отчество может содеражть 3 - 15 символов A-z');
	
}

function password2_valid(){
if( $_POST['password'] !== md5($_POST['password2']))
        message('Пароли не совпадают');
   
}
function send_mail($email, $title, $text){
    
    mail( $email, $title, '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>'.$title.'</title>
</head>

<body>

<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">

<div style="margin:0; background: #464E78; padding: 25px; color: #fff;">'.$title.'</div>
<div style="padding:30px;">
<div style="background #fff; border-radius: 10px; padding: 25px; border: 1px solid #EEEFF2">'.$text.'</div>
</div>
</div>


</body>

</html>', "From: admin@mysite.com\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8");
}

function top( $title ) {
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>'.$title.'</title>
<link rel="stylesheet" href="/style.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script type="text/javascript" src="/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="slider/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="slider/js/custom.js"></script>
<link rel="stylesheet" href="slider/css/jquery.bxslider.css">
<script src="/script.js"></script>
</head>

<body>


<div class="wrapper">

<div class="menu">';

if($_SESSION[id])
    echo'
<a href="/home">Главная</a>
<a href="/reviews">Отзывы</a>
<a href="/profile">Профайл</a>
<a href="/history">История</a>
<a href="/referral">Рефералы</a>
<a href="/services">Услуги</a>
<a href="/logout">Выход</a>';

else
    echo'
<a href="/login">Вход</a>
<a href="/register">Регистрация</a>';

if($_SESSION['admin'])
    echo'<a href="/admin_room">Админ комната</a>';

echo '
</div>
<div class="content">
<div class="block">';
}



function bottom() {
echo '
</div>
</div>
</div>
</body>
</html>';
}

function up(){
    echo '
    <html>
    <head lang="ru">
    <meta charset="utf-8">
    <title>Соц сеть</title>
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="/responsive.css">
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/scripts/lightbox-gallery/js/jquery.lightbox-0.5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="menu/css/demo.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="menu/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="menu/css/menu_topside.css" />
    <script type="text/javascript" src="/script_page.js"></script>
</head>
    
    ';
}
function doun(){
    echo '
    <div id="page-preloader" class="preloader">
<div class="loader"></div>
</div>
    <script type="text/javascript" src="/script.js"></script>
        
    <link rel="stylesheet" type="text/css" media="all" href="/scripts/lightbox-gallery/css/jquery.lightbox-0.5.css">
<script type="text/javascript" src="scripts/preloader.js"></script>    
<script type="text/javascript" src="menu/js/classie.js"></script>
<script type="text/javascript" src="menu/js/main.js"></script>
<script type="text/javascript" src="particles/particles.js"></script>
<script type="text/javascript" src="particles/app.js"></script>
</body>
</html>
    
    ';
}



?>