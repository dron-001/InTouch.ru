<? up();



//function go_sab_on_iduser( $id ){
    //$CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');
    //$res1 = mysqli_fetch_assoc( mysqli_query($CONNECT, "SELECT * FROM `messages` WHERE `to_id` = '$id' OR `from_id` = '$id'"));
    //print_r($res1);
        
        
    //}












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
            <p align="center">Друзья</p>
        <div class="frends">
            <a href="#" class="frend">Все</a>
            <a href="onfrends" class="frend">В сети</a>
        </div>
        <div class="clear"></div>
        


             
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'Intouch');
    
            $res = mysqli_query($connection, "SELECT `id_user2` FROM `frends` WHERE `id_user1` = '$_SESSION[id]'");
            
            
            
            
            if( mysqli_num_rows($res) == 0){
                echo 'Друзей не найдено';

            }
            else{
                
                while (($ser = mysqli_fetch_assoc($res))) {
                    $res1 = mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = '$ser[id_user2]'");
                    $ser1 = mysqli_fetch_assoc($res1);
                   ?>
                   <a href="user?id=<?
                   $id = $ser[id_user2];
                   echo $id;
                   ?>" style="text-decoration: none;">
                   <div class="user_tab">
                   <div class="useravatar clear">
                   <img style='position: relative; height: 100%; width: 100%;;' src="/avatars/<? echo getavatar($ser[id_user2]) ?>">
                   </div>
                   <div class="user_name_min">
                    <?php
                     echo '<p class="us">'.$ser1['surname'].' '.$ser1['name'].' '.$ser1['patronymic'].'</p>';
                    ?>
                   </div>
                   </div>
                   </a>
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