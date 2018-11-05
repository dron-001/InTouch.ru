












<div class="page__cell  shadow">

        <div class="nav">
            
            
            <div class="nav_nav">
                <div class="nav__item">
                
               <?
               $W = new_message( $_SESSION[id] );
               
               
                if($W != 0){
                    echo '<div class ="new_mess">'.$W.'</div>';
                }?>
                    <a href="messages" class="nav__link link">
                    
                        Сообщения
                    </a>
                    
                </div>
                

                <div class="nav__item">
                    <a href="alerts" class="nav__link link">
                        Оповещения
                    </a>
                </div>

                <div class="nav__item">
                    <a href="settings" class="nav__link link">
                        Настройки
                    </a>
                </div>
                

                   </div>

               

        </div>
        
        
        
        
        
    </div>