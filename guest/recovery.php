<? top('Восстановление пароля') ?>

<h1>Восстановление пароля</h1>

<p>Восстановить можно только те акаунты, котрые привязаны к номеру.</p>
<p><input type="number" placeholder="Номер" id="number"></p>
<p><input type="text" placeholder="<?captcha_show()?>" id="captcha"></p>
<p><button onclick="post_query('gform', 'recovery', 'number.captcha')">Восстановить</button> </p>


<? bottom() ?>