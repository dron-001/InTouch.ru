<?

if($_POST['login_f']){
    
    //captcha_valid();
    
    if($_POST['password'] != '123' or $_SERVER['REMOTE_ADDR'] != '127.0.0.1')
    message('Доступ запрещён');


$_SESSION['admin'] = 1;
go('a_home');
}

?>