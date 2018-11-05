<? 


$connection = mysqli_connect('localhost', 'root', '', 'Intouch');
$url = 'gallery';



        
        
        
    
            if($_POST['send_photo_on_user_f']){
    
             $id_photo2 = array_pop($_POST);
             $_SESSION['img'] = $id_photo2;
             
            }
    
            $res = mysqli_query($connection, "SELECT * FROM `photo_users` WHERE `id_user` = $_SESSION[id] ORDER BY `id_photo` DESC");
            //$ser = mysqli_fetch_assoc($res);


if(isset($_POST['edit_photo']) and !empty($_FILES["avatar"])){
    
    $avatar = $_FILES["avatar"];
    
    if(issecurity($avatar)){
        loadAphoto($avatar, $_SESSION[id]);
        
        
        
        
        
    }   
    else $_SESSION['er'] = 1;
  
    
    
    
    
    
    
    header("Location:".$url);
    
    
    
    
    
    
    
}




        
        
up();

?>

    <body>
<input type="hidden" value='<? echo $url ?>' id="url">
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
            <p align="center">Галерея</p>
            
        
        <form action="gallery" method="post" enctype="multipart/form-data">
        
        
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
                      <a  href='/photo/photo_users/<? echo$np ?>'
                  
                   class='photo_gallery'><img  style=' height: 150px; width: 150px; margin: 5px; border: 5px solid #ADB6BA;' src='/photo/photo_users/<? echo $np ?>'></a>
                   </div>
                   
                   <button type='submit' class="select" onclick="post_query('aform', 'delete', '<? echo $id?>')" ><i class="fas fa-trash"></i></button>
                   
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
</div>
</body>
<? doun();?>
