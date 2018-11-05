<?

if( $_POST['contact_f']){
    //captcha_valid();
	
    
    
    if( strlen($_POST['message']) < 10 or strlen($_POST['message']) > 100)
        message('Длина сообщения должна состовлять 10 -100 символов');
    
    mail('1234@mail.com', 'Обращение в службу поддержки', 'E-mail отправителя: <b>'.$_POST['email'].'</b><p>'.htmlspecialchars($_POST['message']).'</p>');
    
    
    message('Сообщение отправлено');
    
}



?>