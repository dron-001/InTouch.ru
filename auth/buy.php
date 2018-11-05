<?

if( $_POST[services_f]){
    $sid = array_pop($_POST);
    
    $price = services_price( $sid );
    
    if(!$price)
        message('Ошибка покупки услуги');
    
      $price = calc_promo($sid);
      
    if($price > $_SESSION['balance'])
    message( 'Недостаточно средств' );

    $price = calc_promo($sid);


    $_SESSION['balance'] -= $price;
    mysqli_query($CONNECT, "UPDATE users SET balance = $_SESSION[balance] WHERE id = $_SESSION[id]");

mysqli_query($CONNECT, 'INSERT INTO `history` VALUES ("", "'.$_SESSION['id'].'", "Покупка услуги #'.$sid.'")');
message('Готово');
}


else if($_POST['promo_f']){
    
    $disc = services_promo( $_POST['code'] );
    
    if(!$disc)
        message('Промокод указан не верно');
    
    $_SESSION['promo'] = $disc;
    
   go('services');
}



?>