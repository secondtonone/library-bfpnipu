<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once '../../../../temp/menuline.php';?>
<?php require_once '../../../../temp/header.php';?>
<div class="page">
<div id="attentionForm">
	<a class="attentionText" href='../../../user/index.php' >
    <?php if ($_GET["value"]==1){ echo "Ваш аккаунт активирован!";}
	      if ($_GET["value"]==2){ echo "Ваш аккаунт активировать не удалось!Заново перейдите по ссылке.";}
	      if ($_GET["value"]==3){ echo "Код активации не верен!Заново перейдите по ссылке.";}
		  if ($_GET["value"]==4){ echo "Такого пользователя не существует!";}
          if (empty($_GET["value"])){ echo "<html><head><meta http-equiv='Refresh' content='0; URL=../../../../index.php'></head></html>";}?>
         <a>
		</div>
</div>
<?php require_once '../../../../temp/footer.php';?>
</body>
</html>