<?
  /*****************************/
 /******Настройки страницы*****/
/*****************************/
if( $_POST['edit_f'] ){
    if( $_POST['password'] and md5($_POST['password']) != $_SESSION['password']){
        
        password_valid();
        password2_valid();
        

       
        mysqli_query($CONNECT, "UPDATE `users` SET `password` = '$_POST[password]' WHERE `email` = '$_SESSION[email]'");
        
    }
    
    
    if( $_POST['ip'] != $_SESSION['ip']){
        
        if($_POST['ip']){
            
            $arr = explode(',', $_POST['ip']);
            if(count($arr) > 4 )
                message('Лимит 1 - 5 IP');
            
            foreach($arr as $key => $value){
                if( !filter_var($value, FILTER_VALIDATE_IP))
                    message("IP $value указан неверно");
            }
            
            
            
            $_SESSION['ip'] = $_POST['ip'];
        }else $_SESSION['ip'] = "";
        
        mysqli_query($CONNECT, "UPDATE users SET ip = '$_SESSION[ip]' WHERE email = '$_SESSION[email]'");
        
        
    }
    
    
    
    if( $_POST['protected'] != $_SESSION['protected']){
        
        
        if( $_POST['protected'] == 1)
            $_SESSION['protected'] = 1;
        else
            $_SESSION['protected'] = 0;
        
        
        mysqli_query($CONNECT, "UPDATE users SET protected = $_SESSION[protected] WHERE email = '$_SESSION[email]'");
        
    }
    
    
    
    message("Сохранено");

}

  /**************************************/
 /******Остановка заявки в друзья*******/
/**************************************/
if($_POST['stop_frend_f']){
    
    
    $id_user = $_POST[id_user];
   
    
                  mysqli_query($CONNECT, "DELETE FROM `frends` WHERE `id_user1` = $_SESSION[id] AND `application` =  $id_user");
                  mysqli_query($CONNECT, "DELETE FROM `alerts` WHERE `from_alert` = $_SESSION[id] AND `to_alert` =  $id_user");
                  go('user?id='.$id_user);
}
  /***********************************/
 /******Отправка заявки в друзья*****/
/***********************************/
if( $_POST['go_frend_f'] ){
    
   $id_user = $_POST[id_user];
    
  $res3 = mysqli_query($CONNECT, "SELECT `id_user2` FROM `frends` WHERE `id_user1` = '$id_user' AND `application` = '$_SESSION[id]'");
  $ser3 = mysqli_fetch_assoc($res3);
  
  
                
                if($ser3){
                    
                    
                            mysqli_query($CONNECT, "UPDATE `frends` SET `id_user2` = '$_SESSION[id]' WHERE `id_user1` = '$id_user' AND `application` = '$_SESSION[id]'");
                            mysqli_query($CONNECT, "UPDATE `frends` SET `application` = 0 WHERE `id_user1` = '$id_user' AND `application` = '$_SESSION[id]'");      
                            mysqli_query($CONNECT, 'INSERT INTO `frends` VALUES ("'.$_SESSION[id].'", "'.$id_user.'", "" )');
   
                            go('user?id='.$id_user);
                }
                else{
    
               
    
                mysqli_query($CONNECT, 'INSERT INTO `frends` VALUES ("'.$_SESSION[id].'", "", "'.$id_user.'" )');
                $date = date("d-m-Y-H:i");
                
                mysqli_query($CONNECT, 'INSERT INTO `alerts` VALUES ("", "Заявка в друзья", " Хочет добавить вас в друзья", "'.$date.'",  "'.$_SESSION[id].'", "'.$id_user.'", 0 )');
                
                $res4 = mysqli_query($CONNECT, "SELECT `id_alert` FROM `alerts` WHERE `from_alert` = '$_SESSION[id]' AND `to_alert` = '$id_user'");
                $ser4 = mysqli_fetch_assoc($res4);
                
                mysqli_query($CONNECT, 'INSERT INTO `alert_us` VALUES ("'.$ser4[id_alert].'", "'.$id_user.'"  )');
                }
                go('user?id='.$id_user);
                
   
    
}
  /***********************************/
 /******Принятие заявки в друзья*****/
/***********************************/
if( $_POST['yes_frends_f'] ){
    
   $id_alert = array_pop($_POST);
   $from = array_pop($_POST);
   
   
    mysqli_query($CONNECT, "UPDATE frends SET `id_user2` = '$_SESSION[id]' WHERE `id_user1` = $from AND `application` = '$_SESSION[id]'");
    mysqli_query($CONNECT, "UPDATE frends SET `application` = 0 WHERE `id_user1` = $from AND `application` = '$_SESSION[id]'");
    mysqli_query($CONNECT, 'INSERT INTO `frends` VALUES ("'.$_SESSION[id].'",  "'.$from.'", "" )');
    mysqli_query($CONNECT, "DELETE FROM `alerts` WHERE `id_alert` = $id_alert");
    go('alerts');
}
  /***********************************/
 /****Не принятие заявки в друзья****/
/***********************************/
if( $_POST['no_frends_f'] ){
    
   $id_alert = array_pop($_POST);
   
   
   
    
    mysqli_query($CONNECT, "DELETE FROM `alert_us` WHERE `id_alert` = $id_alert");
    go('alerts');
}
  /***********************************/
 /******Удаление из друзей***********/
/***********************************/
if( $_POST['del_frend_f'] ){
    
    $id_user = $_POST[id_user];
    
    
    
    
                  mysqli_query($CONNECT, "DELETE FROM `frends` WHERE `id_user1` = $_SESSION[id] AND `id_user2` = $id_user");
                  mysqli_query($CONNECT, "DELETE FROM `frends` WHERE `id_user1` = $id_user AND `id_user2` = $_SESSION[id]");
                go('user?id='.$id_user);
                
   
    
}
  /***********************************/
 /******Блокирование пользователя****/
/***********************************/
if( $_POST['block_f'] ){
    
    $id_user = $_POST[id_user];
    
    
    
    
                  mysqli_query($CONNECT, 'INSERT INTO `black_list` VALUES ("'.$_SESSION[id].'", "'.$id_user.'" )');
                  
                go('user?id='.$id_user);
                
   
    
}
  /***********************************/
 /***Разблокирование пользователя****/
/***********************************/
if( $_POST['an_block_f'] ){
    
    $id_user = $_POST[id_user];
    
    
    
    
                  mysqli_query($CONNECT, "DELETE FROM `black_list` WHERE `id_user1` = $_SESSION[id] AND `id_user2` = $id_user");
                  
                go('user?id='.$id_user);
                
   
    
}

if($_POST['edit_data_f']){
    
    name_valid();/*Проверка имени*/
    surname_valid();/*Проверка фамилии*/
    patronymic_valid();/*Проверка отчества*/
   
    
    mysqli_query($CONNECT, "UPDATE users SET `name` = '$_POST[name]' WHERE `id` = '$_SESSION[id]'");
    mysqli_query($CONNECT, "UPDATE users SET `surname` = '$_POST[surname]' WHERE `id` = '$_SESSION[id]'");
    mysqli_query($CONNECT, "UPDATE users SET `name` = '$_POST[patronymic]' WHERE `id` = '$_SESSION[id]'");
    
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['surname'] = $_POST['surname'];
    $_SESSION['patronymic'] = $_POST['patronymic'];
    go('new_data');
    
    
    
    
    
    
}
  /***********************************/
 /*****Удаление фото пользователя****/
/***********************************/
if($_POST['delete_f']){
    
             $id_photo2 = array_pop($_POST);
            
             mysqli_query($CONNECT, "DELETE FROM `photo_users` WHERE `id_user` = $_SESSION[id] AND `id_photo` = $id_photo2");
             
    go('gallery');
    
}
  /***********************************/
 /**Удаление сообщений пользователя**/
/***********************************/
if($_POST['deletem_f']){
    
            $url = 'sendmess?id='. array_pop($_POST);
            $id_messages = array_pop($_POST);
          
            
             mysqli_query($CONNECT, "DELETE FROM `messages` WHERE `id_messages` = $id_messages ");
             go($url);
    
    
}
  /***********************************/
 /**Удаление новостей пользователя***/
/***********************************/
if($_POST['delete_news_f']){
    
    
    $id = array_pop($_POST);
             
             
            
             mysqli_query($CONNECT, "DELETE FROM `news` WHERE `id_news` = $id");
             mysqli_query($CONNECT, "DELETE FROM `news_users` WHERE `id_news` = $id");
             
    
}
  /***********************************/
 /***Отправка фото пользователю******/
/***********************************/
if($_POST['select_photo_on_sigin_f']){
    
            $id_photo = array_pop($_POST);
             
    
            ?>
             <div id="thumbnails">
            <a  href='/photo/photo_users/<? echo go_name_photo_on_id( $id_photo ); ?>'class='photo_gallery'>
                  
                   <img  style=' height: 120; width: 150; margin: 15px;' src='/photo/photo_users/<? echo go_name_photo_on_id( $id_photo ); ?>'></a>
                   
                      <input type="hidden" value='' id='none'>
                      </div>
                   <? $_SESSION['img'] = $id_photo; ?>
                   <button onclick="post_query('<? echo $url ?>', 'send_photo_on_user', 'none')">Удалить</button>
                   <?
}
  /***********************************/
 /***Смена аватарки пользователя*****Не РАБОТАЕТ/
/***********************************/
if($_POST['edit_avatar_f']){
    
    
    $id = array_pop($_POST);
    $name_avatar = 'photo/photo_users/'.go_name_photo_on_id($id);
    
    mysqli_query($CONNECT, "UPDATE users SET `avatar` = '$name_avatar' WHERE `id` = '$_SESSION[id]'");

    
    
}
  /***********************************/
 /***Удаление чатов*******************Не РАБОТАЕТ/
/***********************************/
if($_POST['delete_chat_f']){
    
    
    print_r($_POST);
    exit();
  $id_chat = array_pop($_POST);
   
   message($id_chat);
    
    
}
?>
