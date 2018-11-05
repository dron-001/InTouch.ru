<? top('Регистрация') ?>

<h1>Регистрация</h1>


<p><input type="text" placeholder="Имя" id="name" value="<?php echo $_POST['name']; ?>"></p>
<p><input type="text" placeholder="Фамилия" id="surname" value="<?php echo $_POST['surname']; ?>"></p>
<p><input type="text" placeholder="Отчество" id="patronymic" value="<?php echo $_POST['patronymic']; ?>"></p>
<p><input type="text" placeholder="E-mail или номер телефона" id="email" value="<?php echo $_POST['email']; ?>"></p>
<p><input type="password" placeholder="Пароль" id="password"></p>
<p><input type="password" placeholder="Повторите пароль" id="password2"></p>
<p>Пол</p>
<p><select id="sex">


<option value="1">Муж.</option>
<option value="0">Жен.</option>


</select></p>

<p><button onclick="post_query('gform', 'register', 'email.password.name.surname.patronymic.password2.sex')">Регистрация</button> </p>


<? bottom() ?>