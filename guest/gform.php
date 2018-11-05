<?



function go_auth($data){
    foreach ($data as $key => $value) 
		$_SESSION[$key] = $value;
        go('profile');
}

  /*****************/
 /****** Вход *****/
/*****************/

if ($_POST['login_f']) {
    
    
    


	if ( !mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `email` = '$_POST[email]'   ")) )
		message('Аккаунт не найден');


	$row = mysqli_fetch_assoc( mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `email` = '$_POST[email]'") );

    /****** Проверка есть ли ip  в чёрном списке ******/
    if( $row['ip']){
        $arr = explode(',', $row['ip']);
        
        if( !in_array($_SERVER['REMOTE_ADDR'], $arr))
            message("Доступ запрещён для этого IP");
    }
    
    /****** Подтверждение аккаунта по коду ******/
	if ( $row['protected'] == 1){
        	 $code = random_str(5);

	 $_SESSION['confirm'] = array(
        'type' => 'login',
	 	'data' => $row,
	 	'code' => $code,
	 	);

      send_mail($_POST['email'], 'Подтверждение входа', "Код подтверждения входа: $code");
      
      
      go('confirm');
       

       
    }
    
    go_auth($row);
	

	go('profile');

}

  /**********************/
 /******Регистрация*****/
/**********************/

else if ($_POST['register_f']) {
    
    name_valid();/*Проверка имени*/
    surname_valid();/*Проверка фамилии*/
    patronymic_valid();/*Проверка отчества*/
	//captcha_valid();
	email_valid();/*Проверка email*/
	password_valid();/*Проверка пароля*/
    password2_valid();/*Проверка пароля2*/



	if ( mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `email` = '$_POST[email]'")) )/*Проверка не занят ли email*/
	 	message('Этот E-mail занят');

if(is_numeric($_POST[email]))
    $_SESSION['number'] = $_POST[email];


	 $code = random_str(5);
    /*Запись полученных данных в сессию*/
	 $_SESSION['confirm'] = array(
	 	'type' => 'register',
	 	'email' => $_POST['email'],
	 	'password' => md5($_POST['password']),
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'patronymic' => $_POST['patronymic'],
	 	'code' => $code,
        'sex' => $_POST['sex'],
	 	);

send_mail($_POST['email'], 'Регистрация', "Код подтверждения регистрации: $code");


go('confirm');




}







  /********************************/
 /******Восстановление пароля*****/
/********************************/


else if ($_POST['recovery_f']) {
		

		if ( !mysqli_num_rows(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `number` = '$_POST[number]'")))
			message('Аккаунт не найден');

		$code = random_str(5);

	 $_SESSION['confirm'] = array(
	 	'type' => 'recovery',
	 	'number' => $_POST['number'],
	 	'code' => $code,
	 	);

	 send_mail($_POST['email'], 'Восстановление пароля', "Код подтверждения восстановление пароля: $code");

	 go('confirm');


}











  /******************************************************************/
 /******Подтверждение: регистрации, входа, востановления пароля*****/
/******************************************************************/
else if ($_POST['confirm_f']) {

	

           /*Подтверждение регистрации*/
	if ( $_SESSION['confirm']['type'] == 'register') {




		if ( $_SESSION['confirm']['code'] != $_POST['code'] )
				message('Код подтверждения регистрации указан неверно');
            
            
            if( is_numeric($_COOKIE['ref']) )
                $ref = $_COOKIE['ref'];
            else 
                $ref = 0;

            
			mysqli_query($CONNECT, 'INSERT INTO `users` VALUES ("", "'.$_SESSION['confirm']['email'].'", "'.$_SESSION['confirm']['password'].'", "'.$_SESSION['confirm']['name'].'", "'.$_SESSION['confirm']['surname'].'", "'.$_SESSION['confirm']['patronymic'].'", "", "'.$_SESSION['confirm'][sex].'", "", "", "", 1, "", 0, "", '.$ref.', 0, "", 0, "'.$_SESSION['number'].'")');
            //mysqli_query($CONNECT, 'INSERT INTO `users` VALUES ("", "'.$_SESSION['confirm']['email'].'", "'.$_SESSION['confirm']['password'].'", "'.$_SESSION['confirm']['name'].'", "'.$_SESSION['confirm']['surname'].'", "'.$_SESSION['confirm']['patronymic'].'", "", "'.$_SESSION['confirm'][sex].'", "", "", "",  "", "", 0, "", '.$ref.', 0, "", 0, "'.$_SESSION['number'].'")');
            unset($_SESSION['confirm']);
            unset($_SESSION['number']);
            go('login');
		}



                      /*Подтверждение востановления пароля*/
		else if ( $_SESSION['confirm']['type'] == 'recovery') {
            
            if ( $_SESSION['confirm']['code'] != $_POST['code'] )
				message('Код подтверждения регистрации указан неверно');


            
            

            $_SESSION['pass'] = 1;
            
            go('newpass');
            
			

	    }
        
         
         /*Подтверждение входа*/
        else if ( $_SESSION['confirm']['type'] == 'login'){
            if ( $_SESSION['confirm']['code'] != $_POST['code'] )
				message('Код подтверждения регистрации указан неверно');
            
            
            $row = $_SESSION['confirm']['data'];
            unset($_SESSION['confirm']);
            unset($_SESSION['captcha']);
            go_auth($row);
        }

	
	else not_found();






}
  /***********************/
 /******Новый пароль*****/
/***********************/
else if ($_POST['new_f']){
    $new = $_POST['password'];
    password_valid();
    password2_valid();
    
    
    mysqli_query($CONNECT, 'UPDATE `users` SET `password` = "'.$_POST['password'].'" WHERE `number` = "'.$_SESSION['confirm']['number'].'"');
            
			//unset($_SESSION['confirm']);
           
            
            session_destroy();
			message("Ваш новый пароль: ".$new);
            
            
}





?>