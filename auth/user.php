<? 
$id = $_GET[id];
$url = 'user?id='.$id;
//var_dump($_SESSION[iduser]);
$connection = mysqli_connect('localhost', 'root', '', 'Intouch');
    
            $res = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = $_GET[id]");
            $ser = mysqli_fetch_assoc($res);
            $res2 = mysqli_query($connection, "SELECT * FROM `frends` WHERE `id_user1` = $_SESSION[id]");
            $ser2 = mysqli_fetch_assoc($res2);
            $res3 = mysqli_query($connection, "SELECT * FROM `black_list` WHERE `id_user1` = $_SESSION[id] AND `id_user2` = $_GET[id]");
            $ser3 = mysqli_fetch_assoc($res3);
            $res4 = mysqli_query($connection, "SELECT * FROM `photo_users` WHERE `id_user` = $_GET[id] ORDER BY `id_photo` DESC");
            
            
            
                   
            
            $new = mysqli_query($connection, "SELECT * FROM `news` WHERE `id_autor` = '$_GET[id]' ORDER BY `id_news` DESC");
            
     
up();     
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
            <p align="center">Пользователь</p>
         <div class="up">
         <div class="usera">
         <div class="user_photo"> 
            <img style='position: relative; height: 100%; width: 100%;' src="/avatars/<? echo getavatar($_GET[id]) ?>">
            </div>
            
            <div class="user_name">
            <?
            echo $ser['surname'].' '.$ser['name'].' '.$ser['patronymic'];
            ?>
            </div>
            <div class="clear"></div>
        </div>
        <input type="hidden" value='<? echo $id ?>' id='id_user'>
        <button style= "float: right; margin-right: 90px; margin-top: 10px;" onclick="go('sendmess?id=<?
                   $id = $ser['id'];
                   echo $id;?>
                   ')" >Сообщение</button>
        

      
        
        
         
        <?
        if($ser2[id_user2] == $_GET[id] ){
            ?>
        <button onclick="post_query('aform', 'del_frend', 'id_user')">Удалить из друзей</button>
            
            <?
        }
        else if( $ser2[application] == $_GET[id]){
            ?>
            
        
        <button  onclick="post_query('aform', 'stop_frend', 'id_user')">Отменить запрос</button>
            
            <?
        }
        else{
            ?>
            
        
        <button   onclick="post_query('aform', 'go_frend', 'id_user')">Добавить в друзья</button>
            
            <?
        }
        ?>
     </br>
     <?
     if($ser3){
     ?>
        
        <button   onclick="post_query('aform', 'an_block', 'id_user')">Разблокировать</button>
        <?
     }
     else{
         ?>
        <button   onclick="post_query('aform', 'block', 'id_user')">Заблокировать</button>
        <?
     }
        ?>
       
        
                      
                      
  
                      </div>
                   
                 
     
       
       <div class="usinfo">
<p class="inf">Город:</p>
<p class="inf">День рождения:</p>
</div> 
        <?if(!mysqli_num_rows($res4) == 0){?>
        
        <div class="photo_users">
        <p>Фото пользователя</p>
        <div id="slider-container">
        <ul class="slides">
        <? 
        while($ser4 = mysqli_fetch_assoc($res4)){
        
            ?>
            
            <li style='height: 190px; width: 140px; overflow: hidden;'><img style='position: relative; height: 100%; width: 100%;' src="/photo/photo_users/<? echo go_name_photo_on_id($ser4['id_photo']) ?>"></li>
            <?
        }
        ?>
        
     
        </ul>
        
        <ul class="buttons">
        <li class="prev">prev</li>
        <li class="next">next</li>
        </ul>
        
        </div>
        </div>
         <?}?>
            <p align="center">Стена пользователя</p>
        
        
        
            <?
            
            if( mysqli_num_rows($new) == 0){
                echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                У пользователя нет событий
                </div>';

            }
            else{
                
                while ($news = mysqli_fetch_assoc($new))  {
                    
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

</div>

</body>



<? doun();?>