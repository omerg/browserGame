<?php
session_start();
if(!session_is_registered("myusername")){
header("location:main_login.php");
}
?>
<?php
include 'functions.php'; 
?>
<?php 

upgrade($_POST['upgrade_to']); 
header("location:index.php");
?>