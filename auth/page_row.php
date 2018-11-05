<script type="text/javascript">
$(function() {
    $('#thumbnails a').lightBox();
     
});
</script>
<div class="page__row shadow" >
    
    <div class="clear"></div>

    <div class="page__cell2" >
        <div class="clear"></div>
    <div class="back"  >
        <a href="#" class="link">
            Начать
        </a>
    </div>


    </div>


<div class="pc3 page__bgcolor">
   <div class="ps3__item">
       <a href="gallery?id=<?echo $row[id]?>" class="grid__link">
           <img src="images/galery.jpg" alt="" class="grid__picture">
       </a>
       <a href="audio" class="grid__link">
           <img src="images/audio.jpg" alt="" class="grid__picture">
       </a>
       <a href="game" class="grid__link">
           <img src="images/game.jpg" alt="" class="grid__picture">
       </a>

   </div>
</div>

    <div class="nus" align="center">
        <div class="nus__text"><a href="#" class="link">Новости</a></div>
        <?
           $connection = mysqli_connect('localhost', 'root', '', 'Intouch');
           $new = mysqli_query($connection, "SELECT `id_news` FROM `news_users` WHERE `id_user` = '$_SESSION[id]' ORDER BY `id_news` DESC");
           //$news = mysqli_fetch_assoc($new);
           
           
           
            if( mysqli_num_rows($new) == 0){
                echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                У вас нет событий
                </div>';

            }
            else{
                
               
                while (($news = mysqli_fetch_assoc($new)) ) {
                $n = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `news` WHERE `id_news` = '$news[id_news]' ORDER BY `id_news` DESC"));   
                   ?>
                   <div class="message">
                   <div class="left_us clear">
                   
                   <div class="useravatar clear">
                   <img width='100%' src="/avatars/<? echo getavatar($n[id_autor]) ?>">
                   </div>
                   
                   
                   
                   
                   
                   
                   
                   
                   <div class="nameus clear">
                   <a href="user?id=<?
                   $id = $n[id_autor];
                   echo $id;
                   ?>" style="text-decoration: none; font-size: 1.1rem;">
                   
                    <?php
                     echo '<p class="us">'.go_name_on_id( $n[id_autor] ).'</p>';
                    ?>   
                  
                   </a>
                   </div>
                   </div>
                   
                   <? if($n['id_photo'] != 0){
                       
                       ?>
                   <div id="thumbnails">
                       <a  href='/photo/photo_users/<? echo go_name_photo_on_id($n['id_photo']); ?>'
                  
                   class='photo_gallery'><img  style=' height: 120; width: 150; margin: 15px;' src='/photo/photo_users/<? echo go_name_photo_on_id($n[id_photo]); ?>'></a>
                   

                      
                   </div>
                   <?
                   }
                   ?>
                   
                   <div class="textm" style="text-align: left; font-size: 15px;">
                   <?php
                     echo '<p style=" color: #464E78">'.$n['text'].'</p>';
                    ?>   
                   </div>
                   
                   
                   
                   
                   <div class="clear"></div>
                   <div class="date" style="float: right;">
                   
                   <?
                   $dat= $n['date'];
                   $dat1 = substr($dat, 11);
                   $dat2 = substr($dat, 0,10);
                   echo $dat1.'</br>';
                   echo $dat2.'</br>';
                   ?>
                   
                   </div>
                   <div class="clear"></div>
                   </div>
                   <?php
                }
            }
            
            ?>
    </div>




        
</div>