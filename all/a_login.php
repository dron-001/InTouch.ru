<? top('Вход в панель Администратора') ?>

<h1>Вход в панель Администратора</h1>


<p><input type="password" placeholder="Пароль" id="password"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('a_auth', 'login', 'password.captcha')">Войти</button></p>

<? bottom() ?>