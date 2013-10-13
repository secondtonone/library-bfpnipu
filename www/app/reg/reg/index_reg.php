<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../scripts/jquery-1.10.2.js"></script>
</head>
<body>
<div class="menuline"></div>
<?php require_once '../../../temp/header.php';?>
<div class="page">
<form id="regForm">
<div class="left">
<div class="field">
<label>Имя</label>
<input type='text' id='login'/>
</div>
<div class="field">
<label>Пароль</label>
<input type='password' id='pass'/>
</div>
<div class="field">
<label>Повторите пароль</label>
<input type='password' id='pass2'/>
</div>
</div>
<div class="right">
<div class="field">
<label>E-mail</label>
<input type='text' id='email'/>
</div>
<div class="field">
<label>Фамилия</label>
<input type='text' id='fam'/>
</div>
<div class="field">
<label>Номер зачетки</label>
<input type='text' id='number_zach'/>
</div>
</div>
<div class="submit">
<button type="submit">Регистрация</button>
</div>
</form>
</div>
<script src="index_reg.js"></script>
<?php require_once '../../../temp/footer.php';?>
</body>
</html>