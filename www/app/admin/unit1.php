<?php require_once '../scripts/startsession.php';?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/jqgrid/js/jquery-1.9.0.min.js"></script>
</head>
<body>
<?php require_once '../../temp/menuline.php';?>
<?php require_once '../../temp/header.php';?>
<?php require_once '../../temp/adminmenu.php';?>
<div class="page">
<div class="content">
<form id="regForm">
<div class="field">
<label>Имя</label>
<input type='text' id='login' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите имя пользователя" title="Должно содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов.">
</div>
<div class="field">
<label>Пароль</label>
<input type='password' id='pass' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов.">
</div>
<div class="field">
<label>Повторите пароль</label>
<input type='password' id='pass2' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Повторите пароль" title="Должен содержать только латинские буквы и цифры от 6 до 20 символов, без других символов и пробелов.">
</div>
<div class="submit">
<button type="submit">Регистрация</button>
</div>
</form>
   <div class="table">
    <table id="list"></table> 
	<div id="pager"></div> 
    </div>
</div>
</div>
<script src="markunit/markunit1.js"></script>
<script src="../scripts/jqgrid/js/grid.locale-ru.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/js/jquery.jqGrid.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/ui.multiselect.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/jquery.searchFilter.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/jquery.tablednd.js" type="text/javascript"></script>
</body>
</html>