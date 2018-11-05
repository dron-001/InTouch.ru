<?php
require "db.php";


$data = $_POST;
if( isset($data['do_signup']))
{
	//здесь регистрируем

	$errors = array();
	if( trim($data['login']) == '')
	{
		$errors[] = 'Введите логин';
	}
	if( trim($data['name']) == '')
	{
		$errors[] = 'Введите имя';
	}
	if( trim($data['surname']) == '')
	{
		$errors[] = 'Введите фамилию';
	}
	if( trim($data['pat']) == '')
	{
		$errors[] = 'Введите отчество';
	}

	if(($data['password']) == '')
	{
		$errors[] = 'Введите пароль';
	}

	if(($data['password_2']) != $data['password'])
	{
		$errors[] = 'Пофторный пороль не верен';
	}
	if( R::count('users', "login = ?", array($data['login']))
		> 0)
	{
		$errors[] = 'Пользователь с тким логином уже есть!';
	}

}
if(empty($errors) and isset($data['do_signup']))
{
	//всё хорошо,можно регистрировать.
	$users = R::dispense('users');
	$users->login = $data['login'];
	$users->password = password_hash($data['password'], PASSWORD_DEFAULT);
	$users->name = $data['name'];
	$users->surname = $data['surname'];
	$users->patronymic = $data['pat'];
	$users->city = $data['city'];
	R::store($users);

	header('Location: index2.php');
exit();

}
?>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style_in2.css">
	<link rel="stylesheet" href="css/responsive.css">
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="java/script.js"></script>
</head>
<body>
	<div class="reg">
<form action="/signup.php" method="POST">
<p> имя:</p>
<input type="text" name="name" value="<?php echo @$data['name']; ?>">

<p> фамилия:</p>
<input type="text" name="surname" value="<?php echo @$data['surname']; ?>">

<p> отчество:</p>
<input type="text" name="pat" value="<?php echo @$data['pat']; ?>">

<p> город:</p>
<input type="text" name="city" value="<?php echo @$data['city']; ?>">

<p>Ваш логин:</p>
<input type="text" name="login" value="<?php echo @$data['login']; ?>">

		<p>Введите ваш пороль:</p>
<input type="password" name="password">

		<p>Повторите ваш пороль:</p>
<input type="password" name="password_2">

	

			<button tupe="submit" name="do_signup">Зарегистрироваться</button>



</form>
</div>
</body>
</html>