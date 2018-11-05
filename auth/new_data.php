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
            <p align="center">Изменить данные</p>


            
            <p><input type="text" placeholder="Имя" value="<?=$_SESSION['name']?>" id="name"></p>
            <p><input type="text" placeholder="Фамилия" value="<?=$_SESSION['surname']?>" id="surname"></p>
            <p><input type="text" placeholder="Отчество" value="<?=$_SESSION['patronymic']?>" id="patronymic"></p>
            


<p><button onclick="post_query('aform', 'edit_data', 'name.surname.patronymic')">Сохранить</button> 

    </div>

    <div class="clear"></div>

</div>
</div>
</div>
</div>




</body>
<? doun();?>