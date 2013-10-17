<?php
if (isset($_SESSION["rights"]) and $_SESSION["rights"]=='User'){
	require_once 'usermenuline.php';
	}else{
if (isset($_SESSION["rights"]) and $_SESSION["rights"]=='Moderator'){
	require_once 'adminmenuline.php';
	}else{
echo '<div class="menuline"></div>';
	}}
?>