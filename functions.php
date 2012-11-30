<?php

//FUNCTIONS

function log_count($id) //Counts a spesific "action_ref" value in "log" table.
{
include 'connect_db.php';

$sql = mysql_query("SELECT COUNT(*) FROM log WHERE id='$_SESSION[my_id]' AND action_id = $id");

while($row = mysql_fetch_array($sql))
{
return $row['COUNT(*)'];
}
}

function mk_ts($date) //Converts a given date into timestamp format
{
$year = substr($date,0,4);
$mon = substr($date,5,2);
$day = substr($date,8,2);
$hour = substr($date,11,2);
$min = substr($date,14,2);
$sec = substr($date,17,2);

return mktime($hour, $min, $sec, $mon, $day, $year);
}

function current_cash()//Calculates player's cash
{
include 'connect_db.php';
$total = 0;
$subtotal_1 = 0;

$sql_1 = mysql_query("SELECT cost FROM log_construction WHERE id='$_SESSION[my_id]'");

while($row = mysql_fetch_array($sql_1))
{
$subtotal_1 += $row['cost'];
}

$subtotal_2 =0;

$sql_2 = mysql_query("SELECT date FROM log WHERE action_ref = 1");
$row_2 = mysql_fetch_array($sql_2);
$last_update = $row_2['date'];

$cur_level = 0;

$sql_3 = mysql_query("SELECT * FROM log WHERE action_ref = 2");

while($row_3 = mysql_fetch_array($sql_3))
{

$sql_4 = mysql_query("SELECT production FROM costs WHERE stage = $cur_level");//KONTROL ET 'CUR_LEVEL
$row_4 = mysql_fetch_array($sql_4);

$subtotal_2 += ((mk_ts($row_3['date']) - mk_ts($last_update)) * $row_4['production']);

$last_update = $row_3['date'];

$cur_level++;
}

$sql_5 = mysql_query("SELECT production FROM costs WHERE stage = $cur_level");//KONTROL ET 'CUR_LEVEL
$row_5 = mysql_fetch_array($sql_5);

$subtotal_3 = 0;
$subtotal_3 = ((mktime()- mk_ts($last_update)) * $row_5['production']);
$total = ceil($subtotal_1 + $subtotal_2 + $subtotal_3);

return $total;
}

function is_upgradable($id)//Checks whether there is enough cash for the current upgrade of the given mine.
{

include 'connect_db.php';

$sql_1 = mysql_query("SELECT value FROM costs WHERE stage = $id");
$row_1 = mysql_fetch_array($sql_1);

if(current_cash() >= $row_1['value'])
{
echo "
	<form name='upgrade' method='post' action='upgrade.php'>
	<input type='hidden' name='upgrade_to' value='" . $id . "'/>
	<a href='javascript:document.upgrade.submit()'> ";
}
}


function upgrade($id)//Upgrades the given type of mine to the next level
{

include 'connect_db.php';

$sql_1 = mysql_query("SELECT value FROM costs WHERE stage = $id");
$row_1 = mysql_fetch_array($sql_1);

$value = $row_1['value']*(-1);

$sql_2 =mysql_query("INSERT INTO log (action_id, value, id) VALUES (02, $value, $_SESSION[my_id])");
}

function description($id)//Extracts the description of the unit with the given id
{
include 'connect_db.php';

$sql_1 = mysql_query("SELECT abstract FROM entity_index WHERE id = $id");
$row_1 = mysql_fetch_array($sql_1);

echo $row_1['abstract'];
}

function cost($id, $lvl)//Extracts the upgrade cost information of the unit with the given id and level
{
include 'connect_db.php';

$sql_1 = mysql_query("SELECT value FROM costs WHERE id = $id AND stage = $lvl");
$row_1 = mysql_fetch_array($sql_1);

echo $row_1['value'];
}

function list_construction()//Builds the Constructions Menu by checking construction_log and producing HTML
{
include 'connect_db.php';

$sql_1 = mysql_query("SELECT * FROM construction_index ORDER BY id");
echo"<table>";
while($row_1 = mysql_fetch_array($sql_1))
{
$id = $row_1['id'];
$name = $row_1['name'];
$abstract = $row_1['abstract'];
$detail = $row_1['detail'];
echo 
"
<tr>
<td>
<img src='construction_sample.gif' />
</td>
<td>
<div class='content_left'>
	<h1>" . $name . "</h1>
	<h2>Level:" . /*echo log_count($id); . */"</h2>
	<b style='font-size:18px'>Description:</b>" . $abstract . "
	<br>
	<b>Cost:</b>" . /*echo cost($id,log_count($id)+1); . */"
</div>
</td>
</tr>
";
}
echo"</table>";
}
?>