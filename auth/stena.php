<?




$connection = mysqli_connect('localhost', 'root', '', 'Intouch');


$new = mysqli_query($connection, "SELECT * FROM `news` WHERE `id_autor` = '$_SESSION[id]' ORDER BY `id_news` DESC");


    
        
        $url = 'stena';  
            
            
            
  
         
            
            
            
           
            
            
            if(isset($_POST['send'])){
                //var_dump($_FILES);
                $_SESSION['message'] = $_POST['text'];
                if( (strlen($_SESSION['message']) < 1 or strlen($_SESSION['message']) > 1000)  ){
                echo('Длина сообщения должна состовлять 1-1000 символов');
                }
                else{                
             
                    
                    
                    
                    
                    
              $_SESSION['message'] =  htmlspecialchars($_SESSION['message']);
              $text = $_SESSION['message'];
              $id_autor = $_SESSION[id];
              $id_photo = $_SESSION['img']; 
              
              
              
             $date = date("d-m-Y-H:i");
             
              
             mysqli_query($connection, 'INSERT INTO `news` VALUES ("", "'.$_SESSION[id].'", "'.$text.'", "'.$id_photo.'", "'.$date.'")');
             $new = mysqli_query($connection, "SELECT * FROM `news` WHERE `id_autor` = '$_SESSION[id]' ORDER BY `id_news` DESC");
             
             $news = mysqli_fetch_assoc($new);
            
             $id_frend = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id_user2` FROM `frends` WHERE `id_user1` = '$_SESSION[id]'"));
             mysqli_query($connection, 'INSERT INTO `news_users` VALUES ( "'.$id_frend[id_user2].'", "'.$news[id_news].'")');
              
           
              
              unset($_SESSION['message']);
              unset($_SESSION['img']);
              
              
              


              
             
                
                }
               
                
                
            header("Location: stena");
            
            }
                $res = mysqli_query($connection, "SELECT * FROM `photo_users` WHERE `id_user` = $_SESSION[id]");
            $ser = mysqli_fetch_assoc($res);
               

        if(isset($_POST['edit_photo']) and !empty($_FILES["avatar"])){
    
    $avatar = $_FILES["avatar"];
    
    if(issecurity($avatar)){
        loadAphoto($avatar, $_SESSION[id]);
        
        header("Location:".$url);
       
        
        
    }   
    else $_SESSION['er'];
     
    
}





 up();








?>

<body>
<script type="text/javascript">
$(function() {
    $('#thumbnails a').lightBox();
     
});
</script>
<div class="qwe">
<div class="select_photo2">
<div class="close_select" style="float: right; width: 25px;; height: 25px; margin: 10px; background: #34C0E2; text-align: center; color: #FFF;">+</div>
<div style="height: 60px; text-align: center; padding-top: 20px; color: #34C0E2; background: #373a47;">Выберите фотографию</div>
  
            
            <p align="center">Галерея</p>
        
        <form action="stena" method="post" enctype="multipart/form-data">
        
        
        <p><input type="file" name="avatar"></input></p>
        <p><button name="edit_photo" type="submit" value="Загрузить">Загрузить</button></p>
        <?
        
        if($_SESSION['er'] == 1){
            echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                Ошибка загрузки изоброжения.
                </div>';
        }
        unset($_SESSION['er']);
        
        
        ?>
        
        
        </form>
</div>

<div class="select_photo">
<div style=" position: relative; overflow: hidden;">


       
        
        <?
        
        if( mysqli_num_rows($res) == 0){
                echo '<p>Нет ни одной фотографии</p>';

            }
            else{
                while (($ser = mysqli_fetch_assoc($res))) {
                  $np = go_name_photo_on_id($ser['id_photo']);
                  $id = $ser['id_photo'];
                  
                      echo '<input type="hidden" value='.$url.' id="url">';
                      echo '<input type="hidden" value='.$id.' id='.$id.'>';
                      ?>
                      <img class="select" onclick="post_jpg('aform', 'select_photo_on_sigin', '<? echo $id ?>')" class='go_photo' style=' height: 120; width: 150; margin: 5px; border: 5px solid #ADB6BA;' src='/photo/photo_users/<? echo $np?>'>
                   <?
                  
                }
                
            }
        
        
        ?>
        
       
    
           </div>
           </div>
           </div>

     <div class="container">

<?php include "auth/nmenu.php"; ?>
                

<button class="menu-button" id="open-button"></button>
<div class="content-wrap">
<div id="particles-js"></div> 
    <div class="centrovka">
    <div class="group" >


        
        <?php include "auth/page_cell.php"; ?>

        <div class="page__row shadow" >
            <p align="center">Стена</p>
        
        
        <form action="stena" method="POST" enctype="multipart/form-data">
            <div class="textmess" >
            <div style="height: 250px;">
            <textarea  name="text" style="margin: 0px; width: 300px; height: 132px;"  placeholder="Текст сообщения"></textarea>
            <div class="add_on_mess">
           <p class = "add">Прикрепить</p>
           <div class="this_photo"></div>
           <!--
           
           if($_SESSION['img'] != ''){
               ?>
               <div id="thumbnails">
                       <a  href='/photo/photo_users/ echo go_name_photo_on_id( $_SESSION['img'] ); ?>'
                  
                   class='photo_gallery'><img  style=' height: 120; width: 150; margin: 15px;' src='/photo/photo_users/<? echo go_name_photo_on_id( $_SESSION['img'] ); ?>'></a>
                   
                      <input type="hidden" value='' id='none'>
                      
                   </div>
                   <button onclick="post_query('stena', 'send_photo_on_user', 'none')">Удалить</button>
               
           }
           ?>-->
           <div class="select_add">
           <p id="add_photo">Фото</p>
           <p>Видео</p>
           <p>Аудио</p>
           <p>Файл</p>
           </div>
           </div>
           </div>
            <button type="submit" name="send" >Написать</button>
            </form>
            <?
            
            if( mysqli_num_rows($new) == 0){
                echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                У вас нет событий
                </div>';

            }
            else{
                
                while (($news = mysqli_fetch_assoc($new)) ) {
                    
                   ?>
                   <div class="message">
                   <div class="left_us clear">
                   
                   <div class="useravatar clear">
                   <img width='100%' src="/avatars/<? echo getavatar($news[id_autor]) ?>">
                   </div>
                   
                   
                   
                   
                   
                   
                   
                   
                   <div class="nameus clear">
                   <a href="user?id=<?
                   $id = $ser1['from_id'];
                   echo $id;
                   ?>" style="text-decoration: none; font-size: 1.1rem;">
                   
                    <?php
                     echo '<p class="us">'.go_name_on_id( $news[id_autor] ).'</p>';
                    ?>   
                  
                   </a>
                   </div>
                   </div>
                   
                   <? if($news['id_photo'] != 0){
                       
                       ?><div id="thumbnails">
                       <a  href='/photo/photo_users/<? echo go_name_photo_on_id($news['id_photo']); ?>'
                  
                   class='photo_gallery'><img  style=' height: 120; width: 150; margin: 15px;' src='/photo/photo_users/<? echo go_name_photo_on_id($news['id_photo']); ?>'></a>
                   

                      
                   </div><?
                   }
                   ?>
                   
                   <div class="textm" style="text-align: left; font-size: 15px;">
                   <?php
                     echo '<p style=" color: #464E78">'.$news['text'].'</p>';
                     $id = $news['id_news'];
                    ?>   
                   </div>
                   
                   
                   
                   
                   
                   
                   <div class="clear"></div>
                   <input type="hidden" value='<? echo $id?>' id="<? echo $id?>">
                   <button style="float: right;" type='submit'  onclick="post_query('aform', 'delete_news', '<? echo $id ?>')" ><i class="fas fa-trash"></i></button>
                   <div class="date">
                   
                   <?
                   $dat= $news['date'];
                   $dat1 = substr($dat, 11);
                   $dat2 = substr($dat, 0,10);
                   echo $dat1.'</br>';
                   echo $dat2.'</br>';
                   ?>
                   
                   </div>
                   </div>
                   <?php
                }
            }
            
            ?>
        
        
    </div>
    




</div>
</div>
</div>
</div>
</body>
<? doun();?>