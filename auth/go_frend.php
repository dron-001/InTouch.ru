<? up();
$connection = mysqli_connect('localhost', 'root', '', 'Intouch');

$res = mysqli_query($connection, "SELECT * FROM `alerts` WHERE `to_alert` = '$_SESSION[id]' AND `status` = 1");

  







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
            <p align="center">Оповещения</p>
        <div class="frends">
        <a href="alerts" class="frend">Новые</a>
        <a href="#" class="frend">Просмотренные</a>
        </div>
        
        
         <?
            
            if( mysqli_num_rows($res) == 0){
                echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD; float: left;
                margin: 10px;">
                Нет просмотренных оповещений.
                </div>';

            }
            else{
                
                while (($ser = mysqli_fetch_assoc($res))) {
                    
                   ?>
                   <div class="alert">
                   <div class="left_us clear">
                   
                   <div class="useravatar clear">
                   <img width='100%' src="/avatars/<? echo getavatar($ser['from_alert']) ?>">
                   </div>
                   
                   
                   
                   
                   
                   
                   
                   
                   <div  class="nameus clear">
                   <a href="user?id=<?
                   $id = $ser['from_alert'];
                   echo $id;
                   ?>" style="text-decoration: none; font-size: 1.1rem;">
                   
                    <?php
                     echo '<p class="us">'.go_name_on_id( $ser['from_alert'] ).'</p>';
                    ?>   
                  
                   </a>
                   </div>
                   </div>
                   
                   <div class="textm" style="text-align: left; font-size: 15px; padding-bottom: 50px;">
                   <?php
                     echo '<p style=" color: #464E78">'.go_name_on_id( $ser['from_alert']).' '.$ser['text'].'</p>';
                    ?>   
                   </div>
                   <div class="dest">
                   <?
                   $from_alert = $ser['from_alert'];
                   $id_alert = $ser['id_alert'];
                   ?>
                   
                   <input type="hidden" value="<? echo $from_alert?>" id = <? echo $from_alert?> >
                   <input type="hidden" value="<? echo $id_alert?>" id = <? echo $id_alert?> >
                   <button onclick="post_query('aform', 'yes_frends', '<? echo $from_alert?>.<? echo $id_alert?>')">Принять</button>
                   <?//<button id="des2" onclick="post_query('aform', 'frend_des', 'des2.idusf')">Отказать</button>?>
                   
                   
                   <? $id_user = $ser[from_alert] ?>
                   
                   
                   
                   </div>
                   <div class="clear"></div>
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