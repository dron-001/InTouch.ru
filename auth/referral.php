<?top('Рефералы') ?>

<h1>Рефералы</h1>
<p>Ваша реферальная ссылка: <b>http://in.ru?ref=<?=$_SESSION['id']?> </b></p>


<?

$query = mysqli_query($CONNECT, "SELECT email FROM users WHERE ref = $_SESSION[id]");
if( !mysqli_num_rows($query) ) exit('<p>Список рефералов пуст</p>');

$i = 1;
while ( $row = mysqli_fetch_assoc($query)){
    echo '<p># '.($i ++).'. '.$row['email'].'</p>';
    
    
}


 bottom() ?>  