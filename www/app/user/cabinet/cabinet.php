<?php require_once '../scripts/startsessionstudent.php';
require_once '../scripts/connect.php';?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jquery-1.10.2.js"></script>
<script src="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
</head>
<body>
<?php require_once '../../temp/usermenuline.php';
require_once '../../temp/header.php';?>
<div class="page">
<div class="personal">
<div class="legend">Контактные данные</div>
<div class="p_content">
<?php require_once 'cabinet/beginformppl.php';?>
</div>
</div>
<div class="accaunt">
<div class="legend">Данные аккаунта</div>
<div class="a_content">
<?php require_once 'cabinet/beginformacc.php';?>
</div>
</div>
</div>
<script src="cabinet/changeform.js"></script>
<script src="../scripts/tooltip.js"></script>
</body>
</html>