<? up();?>

<body class="page" >
<div class="centrovka">


    <?php include "auth/nav.php"; ?>
        <?php include "auth/page_cell.php"; ?>
    <div class="page__row page__bgcolor" >
        <p align="center">Все пользователи</p>
        
        <?php
            $connection = mysqli_connect('localhost', 'root', '', 'Intouch');
    
            $res = mysqli_query($connection, "SELECT id, name, surname, patronymic FROM `users`");
            if( mysqli_num_rows($res) == 0){
                echo 'Друзей не найдено';

            }
            else{
                
                while (($ser = mysqli_fetch_assoc($res))) {
                    
                   ?>
                   <a href="user?id=<?
                   $id = $ser['id'];
                   echo $id;
                   ?>" style="text-decoration: none;">
                   <div class="user_tab">
                   <div class="useravatar clear">
                   <img style='position: relative; height: 100%; width: auto;' src="/avatars/<? echo getavatar($ser[id]) ?>">
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
            ?>

    </div>
    <?php include "auth/onlain.php"; ?>

</div>




</body>
<? doun();?>