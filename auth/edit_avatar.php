<?
up();
$connection = mysqli_connect('localhost', 'root', '', 'Intouch');
$res = mysqli_query($connection, "SELECT * FROM `photo_users` WHERE `id_user` = $_SESSION[id] ORDER BY `id_photo` DESC");








if(isset($_POST['edit_avatar']) and !empty($_FILES["avatar"])){
    
    $avatar = $_FILES["avatar"];
    if(issecurity($avatar)){
        loadAvatar($avatar, $_SESSION[id]);
        
    }   
    else $_SESSION['er'] = 1;
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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
            <p align="center">Выберите фото</p>
        <form action="edit_avatar" method="post" enctype="multipart/form-data">
        
        
        <p><input type="file" name="avatar"></input></p>
        <p><button name="edit_avatar" type="submit" value="Загрузить">Выбрать фото</button></p>
        <?
        
        if($_SESSION['er'] == 1){
            echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                Ошибка загрузки изоброжения.
                </div>';
        }
        unset($_SESSION['er']);
        
        
        ?>
        
        
        </form>

        <div id="thumbnails">
        <?
        //
        if(mysqli_num_rows($res) == 0){
                echo '<p>Нет ни одной фотографии</p>';

            }
            else{
                while (($ser = mysqli_fetch_assoc($res))) {
                    
                  $np = go_name_photo_on_id($ser['id_photo']);
                  $id = $ser['id_photo'];
                  
                  ?><div class="photo_view">
                  
                  <div class="left">
                     <input type="hidden" value='<? echo $id?>' id="<? echo $id?>">
                      <img onclick="post_query('aform', 'edit_avatar', '<? echo $id?>')"  style=' height: 150px; width: 150px; margin: 5px; border: 5px solid #ADB6BA;' src='/photo/photo_users/<? echo $np ?>'>
                   </div>
                   
                   
                   
                   </div>
                   <?
                
                }
                
            }
        
        
        ?>
        
      </div>
    </div>

    

    
    <div class="clear"></div>
    

</div>
</div>
</div>
</div>

</body>



<? doun();?>