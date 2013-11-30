<?php
session_start();
try {
if (!empty($_SESSION["count"]))
{
echo "У вас имеется ".$_SESSION["count"]." задолжностей!";}
else{
echo "У вас пока нет задолжностей!";	
	}
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>