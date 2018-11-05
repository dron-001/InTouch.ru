<? up();


$connection = mysqli_connect('localhost', 'root', '', 'Intouch');


$new = mysqli_query($connection, "SELECT * FROM `news` WHERE `id_autor` = '$_SESSION[id]' ORDER BY `id_news` DESC");


    
            
            
            
  
            if($_FILES["send_photo"]['error'] == 0){
                       $photo = $_FILES["send_photo"];
                    
                       
                     $_SESSION['img'] = $photo["tmp_name"];
                     
                     
                    }
            
            
            
           
            
            
            if(isset($_POST['send'])){
                
                             
                if($_FILES["send_photo"]['error'] == 0){
                     $photo = $_FILES["send_photo"];
                    
                    
                   
                     if(issecurity($photo)){
                      $type = $photo['type'];
                      $uploaddir = "photo/photo_users/";
                      $name = md5(microtime()).".".substr($type, strlen("image/"));
                      $uploadfile = $uploaddir.$name;
                      
                      
                       if(move_uploaded_file($photo["tmp_name"], $uploadfile)){
        
                         save_photo( $uploadfile, $name);
                         
        
                              $id_photo = go_idphoto_on_namephoto( $name );
                            }
                      
                      
                        }
                    }
                    //
                    
              $_SESSION['message'] =  htmlspecialchars($_SESSION['message']);
              $text = $_SESSION['message'];
              $id_autor = $_SESSION[id];
              
              
              
              
             $date = date("d-m-Y-H:i");
             
              
             mysqli_query($connection, 'INSERT INTO `news` VALUES ("", "'.$_SESSION[id].'", "'.$text.'", "'.$id_photo.'", "'.$date.'")');
             $new = mysqli_query($connection, "SELECT * FROM `news` WHERE `id_autor` = '$_SESSION[id]' ORDER BY `id_news` DESC");
             
             $news = mysqli_fetch_assoc($new);
            // print_r($news);
             $id_frend = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id_user2` FROM `frends` WHERE `id_user1` = '$_SESSION[id]'"));
             mysqli_query($connection, 'INSERT INTO `news_users` VALUES ( "'.$id_frend[id_user2].'", "'.$news[id_news].'")');
              
           
              
              unset($_SESSION['message']);
              unset($_SESSION['img']);
              
              
              


              
             
                
                }
            
            
            


        








?>

<body>

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
        
        
        <form action="stena2" method="POST" enctype="multipart/form-data">
            <div class="textmess">
            <p><textarea id="message" placeholder="Текст сообщения"></textarea></p>
            <input type="file" id="photo" placeholder = "Добавить фото" style = " padding-top: 0; margin-left: 10; padding-bottom: 6;">
            <p><button onclick="post_query('add', 'reviews', 'message.photo')">Добавить</button></p>
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
                       
                       ?><div class="photos">
                   
                      <img height='120' style = " margin: 15px;" src="/photo/photo_users/<? echo go_name_photo_on_id($news[id_photo]); ?>">
                      
                   </div><?
                   }
                   ?>
                   
                   <div class="textm" style="text-align: left; font-size: 15px;">
                   <?php
                     echo '<p style=" color: #464E78">'.$news['text'].'</p>';
                    ?>   
                   </div>
                   
                   
                   
                   
                   
                   
                   <div class="clear"></div>
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