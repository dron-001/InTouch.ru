<? up();


$connection = mysqli_connect('localhost', 'root', '', 'Intouch');
    
            $res = mysqli_query($connection, "SELECT * FROM `photo_users` WHERE `id_user` = $_SESSION[id]");
            $ser = mysqli_fetch_assoc($res);


if(isset($_POST['edit_audio']) and !empty($_FILES["audio"])){
    
    $audio = $_FILES["audio"];
    
    
    
    
    if(issecurity_mp3($audio)){
        
        load_audio($audio, $_SESSION[id]);
        
        
        
        
        
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
            <p align="center">Аудио</p>
        
        
        
        <form action="audio" method="post" enctype="multipart/form-data">
        
        
        <p><input type="file" name="audio"></input></p>
        <p><button name="edit_audio" type="submit" value="Загрузить">Загрузить</button></p>
        <?
        
        if($_SESSION['er'] == 1){
            echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                Ошибка загрузки аудио.
                </div>';
        }
        unset($_SESSION['er']);
        
        
        ?>
        
        
        </form>
        
    </div>
    




</div>
</div>
</div>
</div>
</body>
<? doun();?>

