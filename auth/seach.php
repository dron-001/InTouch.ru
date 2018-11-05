<? up();

       
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
            <p align="center">Поиск</p>
       <? 
       
       
       
          show_seach();
          unset($_SESSION['seach']);
       
       

       
       if(isset($_POST['enter'])){
    
     $_SESSION['seach'] = $_POST['seach'];
   
  
        
        $connection = mysqli_connect('localhost', 'root', '', 'Intouch');
    
            $res = mysqli_query($connection, "SELECT * FROM `users` WHERE `name`  LIKE  '%$_SESSION[seach]%'");
            //$ser = mysqli_fetch_assoc($res);
        
        
       
       
       
       
             
             if( mysqli_num_rows($res) == ''){
                echo 'Такой пользователь не найден';

             }
             else{
                
                
                 //var_dump($ser = mysqli_fetch_assoc($res));
                 
                 while ($ser = mysqli_fetch_assoc($res)) {
                    
                    ?>
                   <a href="user?id=<?
                   $id = $ser['id'];
                   echo $id;
                   ?>" style="text-decoration: none;">
                   <div class="user_tab">
                   <div class="useravatar clear">
                   <img style='position: relative; height: 100%; width: 100%;' src="/avatars/<? echo getavatar($ser[id]) ?>">
                   </div>
                   <div class="user_name_min">
                    <?php
                     echo '<p class="us">'.$ser['surname'].' '.$ser['name'].' '.$ser['patronymic'].'</p>';
                    ?>
                   </div>
                   </div>
                   </a>
                   <?php
                }
            }
       }?>
    </div>
    

</div>
</div>
</div>
</div>

</body>
<? doun();?>