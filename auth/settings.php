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
            <p align="center">Настройки</p>

        <div class="menu">
            <nav class="menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="Settingprof" class="menu__link link">
                            <i class="fas fa-user-edit fa-lg"></i>
                            Настройки профиля
                        </a>
                    </li>

                    <li class="menu__item">
                        <a href="Settingspage" class="menu__link link">
                         <i class="fas fa-pencil-alt fa-lg"></i>
                            Настройки отоброжения страницы
                        </a>
                    </li>

                    <li class="menu__item">
                        <a href="Settingsecuriti" class="menu__link link">
                            <i class="fas fa-shield-alt fa-lg"></i>
                            Настройки безопасности
                        </a>
                        </li>

                </ul>

            </nav>
        </div>
    </div>

    <? echo new_message( $_SESSION[id] );?>

    
    <div class="clear"></div>

</div>
</div>
</div>
</div>




</body>
<? doun();?>