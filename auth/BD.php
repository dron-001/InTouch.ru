<?php

require_onse 'config.php';

$connection = mysqli_connect(
	$config['BD']['server'],
	$config['BD']['username'],
	$config['BD']['password'],
	$config['BD']['name']
	);

if($connection == false){
    echo "Не удалось подключиться к БД!<br>";
    echo mysqli_connect_error();
    exit();
}

?>