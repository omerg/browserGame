<?php
$host="localhost"; // Host name 
$username="browserGameUser"; // Mysql username 
$password="abc"; // Mysql password 
$db_name="browserGame"; // Database name 


// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
?>