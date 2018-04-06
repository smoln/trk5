<?
$type_state = $_GET['type_state'];
if($type_state=="flats" || $type_state=="elite" || $type_state=="newflats"){
$type="city";
}

elseif($type_state=="houses" || $type_state=="cottages" || $type_state=="lands"){
$type="country";
}

$rooms = $_GET['rooms'];
foreach ($rooms as $rooms_name)
{
        $roomss.= "&rooms[]=$rooms_name";
}

$price_from = $_GET['price']['from'];
$price_to = $_GET['price']['to'];
$only_photo = $_GET['only_photo'];

foreach ($price as $price_names){
$prices.= "&price[]=$price_names";
}

$url="http://50.bn.ru/sale/$type/$type_state/??sort=price_for_sort$roomss&price[from]=$price_from&price[to]=$price_to&only_photo=$only_photo";

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="HandheldFriendly" content="True"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<meta name="keywords" content=""/>

</head>
<body>
<header>
</header>
<section>
<table><tr><td>
<form name="filter" action="index.php" method="get">
<table>
<tr>
<td>
<label>Тип недвижимости</label>
<select  name="type_state">
    <option disabled selected value="flats">Жилая</option>
    <option value="flats" <? if($type_state=='flats') print "selected"; ?>>Квартиры (вторичка)</option>
    <option value="elite" <? if($type_state=='elite') print "selected"; ?>>Элитная недвижимость</option>
	<option value="newflats" <? if($type_state=='newflats') print "selected"; ?>>Новостройки</option>
	   <option disabled value="houses">загородная</option>
    <option value="houses" <? if($type_state=='houses') print "selected"; ?>>дома</option>
    <option value="cottages" <? if($type_state=='cottages') print "selected"; ?>>коттеджи</option>
    <option value="lands" <? if($type_state=='lands') print "selected"; ?>>участки</option>
</select>
</td>
</tr>
<tr>
<td class="price">
  <label >Цена <span>(рублей)</span>:</label>
  <input type="text" name="price[from]" value="<? print $price_from;?>" size="6">
  <input type="text" name="price[to]" value="<? print $price_to;?>"  size="6">
</td>
</tr>
<tr>
<td>
<label>Кол-во комнат</label>
<select multiple size="3" name="rooms[]">
<?
for($i=1;$i<=5;$i++){
echo "<option value=\"$i\" >$i"; 
if($i==5){
echo "+";	
}
echo "</option>";
}//for

?>

</select>

</td>
</tr>
<tr>
<td>
<label>ТОЛЬКО С ФОТО</label>
<input type="checkbox" name="only_photo" value="1" <? if ($only_photo==1) print "checked"; ?>>
</td>
</tr>
<tr><td>
<input type="submit" class="button" value="Найти объявления">
</td>
</tr>
</table>

</form>
</td>
<td>
<span>Результат</span>
<?
//--------------result-------------------
//откуда будем парсить информацию: 
$result=file_get_contents($url); 
$out_block=strpos($result,'<div class="result">'); 
$result=substr($result,$out_block); 
$out_block=strpos($result, '<div class="pager">'); 
$result=substr($result,0,$out_block); 
echo iconv('windows-1251', 'utf-8', $result);
?>
</td>
</tr>
</table>
</section>
<footer>
</footer>
</body>



</html>

<?php

?>
