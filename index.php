<?php
session_start();
if(!session_is_registered("myusername")){
header("location:main_login.php");
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>


<?php
include 'functions.php'; 
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<Title>CSS_2 Template Document</Title>
<link rel="stylesheet" type="text/css"href="css_2.css" />

</head>

<body>

    <div id="masterhead">
        
        <div id="logo">
        </div>
        
    </div>
        
    <div id="global_menu">
        
        <div class="global_link">
            <img alt="" src="corner_tsp_tl.gif" height="6" width="6" id="top_left"> 
            <img alt="" src="corner_tsp_tr.gif" height="6" width="6" id="top_right"><a href="#">Planet: #</a>		
        </div>
        <div class="global_link">
            <img alt="" src="corner_tsp_tl.gif" height="6" width="6" id="top_left"> 
            <img alt="" src="corner_tsp_tr.gif" height="6" width="6" id="top_right"><a href="#">Planet: #</a>		
        </div>
        <div class="global_link">
            <img alt="" src="corner_tsp_tl.gif" height="6" width="6" id="top_left"> 
            <img alt="" src="corner_tsp_tr.gif" height="6" width="6" id="top_right"><a href="#">Planet: #</a>		
        </div>
        <div class="global_link">
            <img alt="" src="corner_tsp_tl.gif" height="6" width="6" id="top_left"> 
            <img alt="" src="corner_tsp_tr.gif" height="6" width="6" id="top_right"><a href="#">Planet: #</a>		
        </div>
        <div class="global_link">
            <img alt="" src="corner_tsp_tl.gif" height="6" width="6" id="top_left"> 
            <img alt="" src="corner_tsp_tr.gif" height="6" width="6" id="top_right"><a href="#">Planet: #</a>		
        </div>
        <div class="global_link">
            <img alt="" src="corner_tsp_tl.gif" height="6" width="6" id="top_left"> 
            <img alt="" src="corner_tsp_tr.gif" height="6" width="6" id="top_right"><a href="#">Planet: #</a>		
        </div>
    </div>
    
	<div id="breadcrumb">
    
        <a href="#">QuickLink</a> / <a href="#">QuickLink</a> / <a href="#">QuickLink</a>
        
	</div>
    <table id="pagecell">
    <tr>
    	<td valign="top">
        <!--
        <img alt="" src="corner_tsp_tl.gif" height="12" width="12" id="top_left"> 
        <img alt="" src="corner_tsp_tr.gif" height="12" width="12" id="top_right">
        <img alt="" src="corner_tsp_bl.gif" height="12" width="12" id="bottom_left"> 
        <img alt="" src="corner_tsp_br.gif" height="12" width="12" id="bottom_right">//-->
         
         <!--CONTENT//-->
        	<?php include "$_GET[page]";?>
        <!--CONTENT//-->    	
        </td>
        <td valign="top">
        <!--NAVIGATION BAR//-->
            <?php include 'navigation_bar.php'; ?>
        <!--NAVIGATION BAR//-->                           
        </td>
    </tr>
    </table>

    </div>
    
	<div id="site_info">
    
	</div>

</body>

</html>