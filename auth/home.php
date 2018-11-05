<?
up();



$CONNECT = mysqli_connect('localhost', 'root', '', 'Intouch');

$row = mysqli_fetch_assoc( mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id` = '$_SESSION[id]'") );

?>


<body>


<div class="container">

<?php include "auth/nmenu.php"; ?>
                

<button class="menu-button" id="open-button"></button>
<div class="content-wrap">
<div id="particles-js"></div>
<div class="centrovka" >

<div class="group" >

    
   
    
    <?php include "auth/page_cell.php"; ?>
    <?php include "auth/page_row.php"; ?>

       



    
    <div class="clear"></div>
    </div>
</div>
</div>
</div>


<?
doun();

?>

