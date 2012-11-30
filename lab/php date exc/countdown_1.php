<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<script>
var sec = 30;   // set the seconds
var min = 10;   // set the minutes
var hour = <?php echo date("h"); ?> ;
var day = 01;

function countDown() 
{
	sec--;
	  
	if (sec == -01) 
	{
	sec = 59;
	min--;
	} 
	  
	else 
	{
	 min = min;
	 hour = hour;
	}
	  
	if (sec<=9) 
	{ 
	sec = "0" + sec;
	}
	
	//----------------------
	if (min == -01) 
	{
	min = 59;
	hour = hour - 1;
	} 
	  
	else 
	{
	 hour = hour;
	}
	
	time = (hour<=9 ? "0" + hour : hour) + " hour and " + min + "minutes and" + sec + " sec ";
	
	if (document.getElementById) 
	{ 
	theTime.innerHTML = time; 
	}
	
	SD=window.setTimeout("countDown();", 30);
	
	if (hour == '00' && min == '00' && sec == '00')
	{ 
	sec = "00";
	window.clearTimeout(SD); 
	}
}


function addLoadEvent(func) 
{
	var oldonload = window.onload;
	
	if (typeof window.onload != 'function') 
	{
    window.onload = func;
	} 
	
	else 
	{
    	window.onload = function() 
		{
			if (oldonload) 
			{
			oldonload();
			}
			func();
		}
	}
}

addLoadEvent
	(
		function() 
		{
		countDown();
		}
	);
</script>

<style>
.timeClass {
  font-family:arial,verdana,helvetica,sans-serif;
  font-weight:normal;
  font-size:10pt;
}
</style>


<table width="100%">
 <tr><td width="100%" align="center"><span id="theTime" class="timeClass"></span></td></tr>
</table>
</body>
</html>
