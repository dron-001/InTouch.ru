<? 
var_dump($_SESSION);
if(!$_SESSION['pass'] == 1) not_found();
var_dump($_POST['password']);
top('Новый пароль') ?>


<h1>Вход</h1>


<p><input type="password" placeholder="Новый пароль" id="password"></p>
<p><input type="password" placeholder="Повторите пароль" id="password2"></p>
<p><button onclick="post_query('gform', 'new', 'password.password2')">Сохранить пароль</button></p>

<? bottom() ?>