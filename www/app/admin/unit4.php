﻿<?php require_once '../scripts/startsession.php';?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jquery-1.10.2.js"></script>
</head>
<body>
<?php require_once '../../temp/menuline.php';?>
<?php require_once '../../temp/header.php';?>
<?php require_once '../../temp/adminmenu.php';?>
<div class="page">
<div class="content">
<form action="sync/sync.php" method="post" enctype="multipart/form-data">
<input type="file" name="filename" size="20" />
<input type="hidden" name="update" value="ok" />
<input type="submit" value="Upload" />
</form>
</div>
</div>
<script src="markunit/markunit4.js"></script>
</body>
</html>