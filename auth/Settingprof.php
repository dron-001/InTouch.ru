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
            <p align="center">Настройки профиля</p>
        
        
        <div class="menu">
            <nav class="menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="edit_avatar" class="menu__link link">
                            Сменить аватар
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="new_data" class="menu__link link">
                            Изменить данные
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        


    </div>

<?php include "auth/onlain.php"; ?>

</div>



</div>
</div>
</div>
</div>

</body>
<? doun();?>