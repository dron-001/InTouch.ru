<? up();


$connection = mysqli_connect('localhost', 'root', '', 'Intouch');
$res1 = mysqli_query($connection, "SELECT * FROM `sabs` WHERE  `id_user1` = '$_SESSION[id]' OR `id_user2` = '$_SESSION[id]'");



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

        <div class="page__row page__bgcolor" >
            <p align="center">Сообщения</p>
            <div class="messages">
            
            <?
            
            
   //var_dump( go_sab_on_iduser( $_SESSION[id] ));
            
        // var_dump (go_sab_on_iduser( $_SESSION[id] ));
          // go_sab_on_iduser( $_SESSION[id] );
          
            
            
            if( mysqli_num_rows($res1) == 0){
                echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                У вас пока нет чатов.
                </div>';

            }
            else{
                
                
                while ($chat = mysqli_fetch_assoc($res1)) {
                    
                    if( $chat['id_user1'] == $_SESSION[id]){
                        $id = $chat['id_user2'];
                    }
                    else{
                        $id = $chat['id_user1'];
                    }
                    
                    
                   ?>
                   <a href="sendmess?id=<? echo $id?>">
                   <div class="message">
                   <div class="left_us clear">
                   
                   <div class="useravatar clear">
                   <img width='100%' src="/avatars/<?  echo getavatar( $id ) ?>">
                   </div>
                   
                   
                   
                   
                   
                   
                   
                   
                   <div class="nameus clear">
                   
                   
                    <?php
                     echo '<p class="us" style = "font-size: 1.2rem">'.go_name_on_id( $id ).'</p>';
                     
                    ?>   
                  
                   
                   </div>
                   </div>
                   
                   
                   <div class="clear"></div>
                   </div>
                   </a>
                   <?php
                }
                
            }
            
            
            
            ?>
            
            </div>

        </div>
        

    </div>




    </body>
<? doun();?>