<?php require_once '../scripts/startsession.php';
require_once '../scripts/connect.php';?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once '../../temp/usermenuline.php';
require_once '../../temp/header.php';?>
<div class="page">

<div class="personal">
<div class="legend">Контактные данные</div>
<div class="p_content">

<div class="userForm">
	 <form class="per">
    <div class="field">
   
		<label>Телефон домашний:</label>
		
	</div>
	<div class="field">
		<label>Телефон сотовый:</label>
		
	</div>
    	<div class="field">
		<label>Электронная почта:</label>
		
	</div>
    	<div class="field">
		<label>Рабочий телефон:</label>
		
	</div>
	<div class="submit">
		<button type="submit">Редактировать</button>
        
</div>
</form>
</div>
</div>
</div>

<div class="accaunt">
<div class="legend">Данные аккаунта</div>
<div class="a_content">
<div class="userForm">
<form id="acc">
	<div class="field">
    
		<label>Почта:</label>
		
	</div>
	<div class="field">
		<label>Пароль: ******</label>
		
	</div>
	<div class="submit">
		<button type="submit">Редактировать</button>
        
        </div>
        </form>
		</div>
</div>
</div>
</div>
</div>
</body>
</html>