<?php
include('getMP3info.php');

echo '<pre>';
$info = getMP3data('My music.mp3');
print_r($info);
echo '</pre>';


echo 'Альбом: '.$info['id3v1']['album'].'<br>';
echo 'Битрейт: '.$info['bitrate'];
?>