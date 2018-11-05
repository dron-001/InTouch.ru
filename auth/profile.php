<? 
top('Профайл');

var_dump($_SESSION);
var_dump($_SERVER['REMOTE_ADDR']);
 ?>

<h1>Редактировать</h1>


<p><input type="password" placeholder="Новый пароль" id="password"></p>
<p><input type="text" placeholder="Список ip" value="<?=$_SESSION['ip']?>" id="ip"></p>
<p><select id="protected">


<?=str_replace('"'.$_SESSION['protected'].'"', '"'.$_SESSION['protected'].'" selected', '<option value="0">Подтверждение входа Выкл.</option><option value="1">Подтверждение входа Вкл.</option>');?>


</select></p>
<p><button onclick="post_query('aform', 'edit', 'password.ip.protected')">Сохранить</button> 

<? bottom() ?>