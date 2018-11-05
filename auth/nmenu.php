<?
$avatar = getavatar($_SESSION[id]);


$CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');

$row = mysqli_fetch_assoc( mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id` = '$_SESSION[id]'") );



?>

<div class="menu-wrap">

				<nav class="menu-top">
					
        

        
        <div class="user">
            <?
            echo "<img  style='position: relative; height: 100%; width: 100%;' src='/$avatar'>";
            ?>
        </div>
        <div class="name" style="margin: 0 auto; width: 60px;"><a  href="#"><?=$_SESSION['name']?></a></div>
				
				</nav>
				<nav class="menu-side">
					<a href="home"><i class="fas fa-home fa-lg"></i>Главная</a>
					<a href="stena"><i class="fas fa-edit fa-lg"></i>Моя стена</a>
					<a href="messages"><i class="fas fa-comment fa-lg"></i></i>Сообщения</a>
					<a href="alerts"><i class="fas fa-bell fa-lg"></i>Оповещения</a>
                    <a href="frends"><i class="fas fa-user-friends fa-lg"></i>Друзья</a>
                    <a href="gallery"><i class="fas fa-images fa-lg"></i>Галерея</a>
                    <a href="audio"><i class="fas fa-music fa-lg"></i>Аудио</a>
                    <a href="seach"><i class="fas fa-search fa-lg"></i>Поиск</a>
                    <a href="settings"><i class="fas fa-cog fa-lg"></i>Настройки</a>
                    <a href="logout"><i class="fas fa-times-circle fa-lg"></i>Выйти</a>
				</nav>
                </div>