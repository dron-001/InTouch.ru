<?


function calc_promo($id){
    if($_SESSION['promo']) $promo = $_SESSION['promo'];
    else $promo = 0;
    
    $per =  (services_price($id) * $promo)  / 100;
    return (services_price($id) - $per);
}


 top('Услуги') ?>
<p>Текущий баланс: <?=$_SESSION['balance']?>$</p>



<table>

<tr>
<td>Услуга 1</td>
<td>Услуга 2</td>
<td>Услуга 3</td>
</tr>

<tr>
<td>Стоимость: <?=calc_promo(1)?> $</td>
<td>Стоимость: <?=calc_promo(2)?> $</td>
<td>Стоимость: <?=calc_promo(3)?> $</td>
</tr>

<tr>

<td>
<input type="hidden" value="1" id="sid1">
<p><button onclick="post_query('buy', 'services', 'sid1')">Купить</button> 
</td>

<td>
<input type="hidden" value="2" id="sid2">
<p><button onclick="post_query('buy', 'services', 'sid2')">Купить</button> 
</td>

<td>
<input type="hidden" value="3" id="sid3">
<p><button onclick="post_query('buy', 'services', 'sid3')">Купить</button> 
</td>

<td>
<h1>Получить скиду</h1>




<p><input type="text" placeholder="Промокод"  id="code"></p>

<p><button onclick="post_query('buy', 'promo', 'code')">Отправить</button> 
</td>

</tr>




</table>




<? bottom() ?>