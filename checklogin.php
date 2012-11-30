<?php
include 'connect_db.php';

$tbl_name="account"; // Table name 

// username and password sent from signup form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$array=mysql_fetch_array($result);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_start();
$_SESSION['myusername'] = $myusername;
$_SESSION['mypassword'] = $mypassword;
$_SESSION['my_id'] = $array['id'];
header("location:index.php?page=overview.php");
}
else {
echo "Wrong Username or Password";
}
?>

