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
<form id="giveForm">
<div class="fields">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book' hidden='hidden'>
<input type='text' id='book' required placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group' hidden='hidden'>
<input type='text' id='group' maxlength="20" required pattern="^[a-zA-Z0-9]+$" placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man' hidden='hidden'>
<input type='text' id='name' hidden='hidden'>
<input type='text' id='otch' hidden='hidden'>
<input type='text' id='student' required placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
</div>
<div class="add" title="Добавить дополнительную  форму">Добавить</div>
<button type="submit">Отправить</button>
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
<script src="../scripts/tooltip.js"></script>
</body>
</html>