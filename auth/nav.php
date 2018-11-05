<?
$avatar = getavatar($_SESSION[id]);






?>
<div class = "lefta">
<div clacc="nom" > 
                <button data-target="#nav-main" type="button" class="nom-nav">
                    <span class="nom-nav__line"></span>
                    <span class="nom-nav__line"></span>
                    <span class="nom-nav__line"></span>
                </button> 

                </div>
<div class="left shadow" id="nav-main">

        <div class="fsc">
        <div class="fasset">
    <button type="button" class="button">
        <img src="images/1.png" alt="">
    </button>
    <button type="button" class="button">
        <img src="images/2.png" alt="" class="link">
    </button>
    <button type="button" class="button">
        <img src="images/3.png" alt="" class="link">
    </button>
</div>
        </div>
        <div class="user">
            <?
            echo "<img  style='position: relative; height: 100%; width: auto;' src='/avatars/$avatar'>";
            ?>
        </div>
        <div calss="name"  align="center"><?=$_SESSION['name']?></div>
        
        
        
                <button class="slide_button"  type="button" style = "width: 170">
                    <span class="nom-nav__line"></span>
                    <span class="nom-nav__line"></span>
                    <span class="nom-nav__line"></span>
                </button> 

                
        
        <div class="menu">
            <nav class="menu">
                <ul class="menu__list" >
                    <li class="menu__item">
                        <a href="home" class="menu__link link">
                            Главная
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="stena?id=<? echo $_SESSION[id]?>" class="menu__link link">
                            Моя стена
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="messages" class="menu__link link">
                            Сообщения
                        </a>
                    </li>

                    <li class="menu__item">
                        <a href="alerts" class="menu__link link">
                            Оповещения
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="frends" class="menu__link link">
                            Друзья
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="gallery" class="menu__link link">
                            Галерея
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="audio" class="menu__link link">
                            Аудио
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="seach" class="menu__link link">
                            Поиск
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="settings" class="menu__link link">
                            Настройки
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="logout" class="menu__link link" >
                            Выйти
                        </a>
                    </li>



                </ul>

            </nav>
        </div>
    </div>
    <div class="onlain page__bgcolor shadow ">
        <a href="onfrends" class="text">
            <p align="center">Друзья в сети</p>
        </a>
    </div>
    </div>
    
    
