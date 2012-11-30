
<?php
session_start();
if(session_is_registered("counter")){
echo "session is registered";
echo $_SESSION['counter'];
}
else
{
echo " not registered";
}
?>
