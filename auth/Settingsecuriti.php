<? up();?>

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
            <p align="center">Настройки безопасности</p>



<p><input type="password" placeholder="Новый пароль" id="password"></p>
<p><input type="password" placeholder="Повторите пароль" id="password2"></p>
<p><input type="text" placeholder="Список ip" value="<?=$_SESSION['ip']?>" id="ip"></p>
<p><select id="protected">


<?=str_replace('"'.$_SESSION['protected'].'"', '"'.$_SESSION['protected'].'" selected', '<option value="0">Подтверждение входа Выкл.</option><option value="1">Подтверждение входа Вкл.</option>');?>


</select></p>
<p><button onclick="post_query('aform', 'edit', 'password.password2.ip.protected')">Сохранить</button> 

    </div>

    <div class="clear"></div>

</div>
</div>
</div>
</div>




</body>
<? doun();?>