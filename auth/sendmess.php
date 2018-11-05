<? 

//var_dump($_SESSION[iduser]);
$connection = mysqli_connect('localhost', 'root', '', 'Intouch');


$id = $_GET[id];
        $url = $id;

            $res3 = mysqli_query($connection, "SELECT * FROM `black_list` WHERE `id_user1` = $_GET[id] AND `id_user2` = $_SESSION[id]");
            $ser3 = mysqli_fetch_assoc($res3);
        
        
    
            
            


            
  
            
            
            
            
           
            
            if(isset($_POST['send'])){
                
                $_SESSION['message'] = $_POST['text'];
                //if( ((strlen($_SESSION['message']) < 1) or (strlen($_SESSION['message']) > 1000)) AND ($_FILES["error"] == 4) ){
                    if((strlen($_SESSION['message']) < 1) or (strlen($_SESSION['message']) > 1000) AND $_FILES["send_photo"]['error'] == 4) {
                echo('Длина сообщения должна состовлять 1-1000 символов');
                }
                else{
                 
            
                
                    
                    
                   
                      
                      
                       
                    
              $_SESSION['message'] =  htmlspecialchars($_SESSION['message']);
              $message = $_SESSION['message'];
              $from = $_SESSION[id];
              $to = $_GET[id];
              $id_photo = $_SESSION['img'];
              
              
              
             $s = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `id_user1` FROM `sabs` WHERE (`id_user1` = '$from' AND `id_user2` = '$to') OR (`id_user1` = '$to' AND `id_user2` = '$from') "));
             
             
             if( $s == '' ){
                  mysqli_query($connection, 'INSERT INTO `sabs` VALUES ( "'.$from.'",  "'.$to.'")');
             }
             $date = date("d-m-Y-H:i");
              mysqli_query($connection, 'INSERT INTO `messages` VALUES ("", 0, "'.$message.'", "'.$date.'", "'.$from.'", "'.$to.'", "'.$id_photo.'")');
              
              
           
              
              unset($_SESSION['message']);
              unset($_SESSION['img']);
              
              
              


              
             
                }
            
            
            
            }

$res = mysqli_query($connection, "SELECT * FROM `photo_users` WHERE `id_user` = $_SESSION[id]");
            $ser = mysqli_fetch_assoc($res);


if(isset($_POST['edit_photo']) and !empty($_FILES["avatar"])){
    
    $avatar = $_FILES["avatar"];
    
    if(issecurity($avatar)){
        loadAphoto($avatar, $_SESSION[id]);
        
        header("Location:sendmess?id=".$url);
       
        
        
    }   
    else $_SESSION['er'];
     
    
}

$id = $_GET[id];
       // var_dump($_FILES["send_photo"]['error']);
up();

?>
<body>



<div class="qwe">
<div class="select_photo2">
<div class="close_select" style="float: right; width: 25px;; height: 25px; margin: 10px; background: #34C0E2; text-align: center; color: #FFF;">+</div>
<div style="height: 60px; text-align: center; padding-top: 20px; color: #34C0E2; background: #373a47;">Выберите фотографию</div>
  
            
            <p align="center">Галерея</p>
        
        <form action="sendmess?id=<? echo $id?>" method="post" enctype="multipart/form-data">
        
        
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
    
<script type="text/javascript">
$(function() {
    $('#thumbnails a').lightBox();
     
});
</script>

        
        <?php include "auth/page_cell.php"; ?>

        <div class="page__row shadow" >
            
            <p ><? 
            echo $ser['name'].' ';
            echo $ser['surname'];
            ?></p>
            
            <?
            if(!$ser3){
            ?>
            
            <form action="sendmess?id=<? echo $_GET[id]?>" method="POST" enctype="multipart/form-data">
            <div class="textmess" >
            <div style="height: 250px;">
            <textarea  name="text" style="margin: 0px; width: 300px; height: 132px;"  placeholder="Текст сообщения"></textarea>
            <div class="add_on_mess">
           <p class = "add">Прикрепить</p>
           
           
           <div class="this_photo"></div>
               
               
               
               
           
           
           <div class="select_add">
           <p id="add_photo">Фото</p>
           <p>Видео</p>
           <p>Аудио</p>
           <p>Файл</p>
           </div>
           </div>
           </div>
            <button type="submit" name="send" >Написать</button>
            
            </div>
            </form>
            <?}
            else{
               echo '<p>Вы находитесь в чёрном списке пользователя</p>';
            }?>
            
            
           
            
            <?
            $res1 = mysqli_query($connection, "SELECT * FROM `messages` WHERE `to_id` = '$_SESSION[id]' AND `from_id` = '$_GET[id]'  OR `from_id` = '$_SESSION[id]' AND `to_id` = '$_GET[id]' ORDER BY `id_messages` DESC");
            if( mysqli_num_rows($res1) == 0){
                echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                История переписки пуста
                </div>';

            }
            else{
                
                while (($ser1 = mysqli_fetch_assoc($res1))) {
                    
                   ?>
                   <div class="message <?if($ser1[status] == 0 AND $ser1[to_id] == $_SESSION[id])echo 'new';?>">
                   <div class="left_us clear">
                   
                   <div class="useravatar clear">
                   <img width='100%' src="<? echo getavatar($ser1[from_id]) ?>">
                   </div>
                   
                   
                   
                   
                   
                   
                   
                   
                   <div class="nameus clear">
                   <a href="user?id=<?
                   $id = $ser1['from_id'];
                   echo $id;
                   ?>" style="text-decoration: none; font-size: 1.1rem;">
                   
                    <?php
                     echo '<p class="us">'.go_name_on_id( $ser1['from_id'] ).'</p>';
                    ?>   
                  
                   </a>
                   </div>
                   </div>
                   
                   <div class="textm" style="text-align: left; font-size: 15px;">
                   <?php
                     echo '<p style=" color: #464E78">'.$ser1['text'].'</p>';
                    ?>   
                   </div>
                   <div class="clear"></div>
                   <? if($ser1['id_photo'] != 0){
                       
                       ?><div id="thumbnails">
                       <a  href='/photo/photo_users/<? echo go_name_photo_on_id($ser1['id_photo']); ?>'
                  
                   class='photo_gallery'><img  style=' height: 120; width: 150; margin: 15px;' src='/photo/photo_users/<? echo go_name_photo_on_id($ser1['id_photo']); ?>'></a>
                   

                      
                   </div><?
                   }
                   $id = $ser1['id_messages'];
                   ?>
                   
                   
                   
                   
                   <input type="hidden" value='<? echo $url ?>' id="<? echo $url ?>">
                   <input type="hidden" value='<? echo $id?>' id="<? echo $id?>">
                   <button style="float: right;" type='submit'  onclick="post_query('aform', 'deletem', '<? echo $id.'.'.$url ?>')" ><i class="fas fa-trash"></i></button>
                   <div class="date">
                   
                   <?
                   $dat= $ser1['date'];
                   $dat1 = substr($dat, 11);
                   $dat2 = substr($dat, 0,10);
                   echo $dat1.'</br>';
                   echo $dat2.'</br>';
                   ?>
                   
                   </div>
                   </div>
                   <?
                }
            }
            
            ?>
            
            
            
            
            
            
            
            

        </div>
       

    </div>
    </div>
    </div>
    </div>



<script type="text/javascript">
 
 
 
 
</script>
    </body>
    
<? doun();?>