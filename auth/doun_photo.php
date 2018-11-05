<?
up();
?>


<body class="page" >
<div class="centrovka">


    <?php include "auth/nav.php"; ?>
    <?php include "auth/page_cell.php"; ?>


    <div class="page__row page__bgcolor" >
        <p align="center">Загрузить фото</p>
        <form action="edit_avatar" method="post" enctype="multipart/form-data">
        
        
        <p><input type="file" name="avatar"></input></p>
        <p><button name="edit_avatar" type="submit" value="Загрузить">Загрузить</button></p>
        <?
        
        if($_SESSION['er'] == 1){
            echo '<div style="padding: 0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD;">
                Ошибка загрузки изоброжения.
                </div>';
        }
        unset($_SESSION['er']);
        
        
        ?>
        
        
        </form>

        
    </div>

    

    <?php include "auth/onlain.php"; ?>
    <div class="clear"></div>

</div>




</body>

<? doun();?>