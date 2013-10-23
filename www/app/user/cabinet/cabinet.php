<?php require_once '../scripts/startsession.php';
require_once '../scripts/connect.php';?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jquery-1.10.2.js"></script>
</head>
<body>
<?php require_once '../../temp/usermenuline.php';
require_once '../../temp/header.php';?>
<div class="page">

<div class="personal">
<div class="legend">Контактные данные</div>
<div class="p_content">

<div class="puserForm">
    <div class="field">
   
		<label>Телефон домашний: <div class="formline"><?php echo $result["telefon_dom"]; ?></div></label>
		
	</div>
	<div class="field">
		<label>Телефон сотовый: <div class="formline"> <?php echo $result["telefon_sot"]; ?></div></label>
		
	</div>
    	<div class="field">
		<label>Электронная почта: <div class="formline"> <?php echo $result["e_mail"]; ?></div></label>
		
	</div>
    	<div class="field">
		<label>Рабочий телефон: <div class="formline"><?php echo $result["telefon_rabochii"]; ?></div></label>
		
	</div>
	<div class="submit">
		<button class="perchange" type="button">Редактировать</button>
        
</div>
</div>
</div>
</div>

<div class="accaunt">
<div class="legend">Данные аккаунта</div>
<div class="a_content">
<div class="auserForm">
	<div class="field">
    
		<label>Почта: <div class="formline"> <?php echo $email["email"]; ?></div></label>
		
	</div>
	<div class="field">
		<label>Пароль: <div class="formline"> &bull;&bull;&bull;&bull;&bull;&bull;</div></label>
		
	</div>
	<div class="submit">
		<button class="acchange" type="button">Редактировать</button>
        
        </div>
		</div>
</div>
</div>
</div>
</div>
<script src="cabinet/changeform.js"></script>
</body>
</html>