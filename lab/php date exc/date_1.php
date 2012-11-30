<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>

<?php
$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));

echo ceil(mktime()/10);
?>



</body>
</html>
