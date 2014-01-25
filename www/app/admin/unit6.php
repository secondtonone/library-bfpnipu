<?php require_once '../scripts/startsessionadmin.php';?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
<div class="contenttable">
   <div class="table">
    <table id="list"></table> 
	<div id="pager"></div> 
    </div>
    </div>
<div class="contentform"> 
<form id="giveForm">
<div class="fields">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book' hidden='hidden'>
<input type='text' id='book' required placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать."></div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group' hidden='hidden'>
<input type='text' id='group' maxlength="20" required  placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать."></div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man' hidden='hidden'>
<input type='text' id='name' hidden='hidden'>
<input type='text' id='otch' hidden='hidden'>
<input type='text' id='student' required  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields1">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book1' hidden='hidden'>
<input type='text' id='book1'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать."></div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group1' hidden='hidden'>
<input type='text' id='group1' maxlength="20"  placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man1' hidden='hidden'>
<input type='text' id='name1' hidden='hidden'>
<input type='text' id='otch1' hidden='hidden'>
<input type='text' id='student1'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields2">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book2' hidden='hidden'>
<input type='text' id='book2'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group2' hidden='hidden'>
<input type='text' id='group2' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man2' hidden='hidden'>
<input type='text' id='name2' hidden='hidden'>
<input type='text' id='otch2' hidden='hidden'>
<input type='text' id='student2'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields3">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book3' hidden='hidden'>
<input type='text' id='book3'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group3' hidden='hidden'>
<input type='text' id='group3' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man3' hidden='hidden'>
<input type='text' id='name3' hidden='hidden'>
<input type='text' id='otch3' hidden='hidden'>
<input type='text' id='student3'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields4">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book4' hidden='hidden'>
<input type='text' id='book4'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group4' hidden='hidden'>
<input type='text' id='group4' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man4' hidden='hidden'>
<input type='text' id='name4' hidden='hidden'>
<input type='text' id='otch4' hidden='hidden'>
<input type='text' id='student4'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields5">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book5' hidden='hidden'>
<input type='text' id='book5'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group5' hidden='hidden'>
<input type='text' id='group5' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man5' hidden='hidden'>
<input type='text' id='name5' hidden='hidden'>
<input type='text' id='otch5' hidden='hidden'>
<input type='text' id='student5'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields6">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book6' hidden='hidden'>
<input type='text' id='book6'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group6' hidden='hidden'>
<input type='text' id='group6' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man6' hidden='hidden'>
<input type='text' id='name6' hidden='hidden'>
<input type='text' id='otch6' hidden='hidden'>
<input type='text' id='student6'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields7">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book7' hidden='hidden'>
<input type='text' id='book7'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group7' hidden='hidden'>
<input type='text' id='group7' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man7' hidden='hidden'>
<input type='text' id='name7' hidden='hidden'>
<input type='text' id='otch7' hidden='hidden'>
<input type='text' id='student7'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields8">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book8' hidden='hidden'>
<input type='text' id='book8'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group8' hidden='hidden'>
<input type='text' id='group8' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man8' hidden='hidden'>
<input type='text' id='name8' hidden='hidden'>
<input type='text' id='otch8' hidden='hidden'>
<input type='text' id='student8'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="fields9">
<div class="field">
<label>Книга</label>
<input type='text' id='id_book9' hidden='hidden'>
<input type='text' id='book9'  placeholder="Введите название книги" title="Начните печатать, появятся варианты из которых нужно выбрать.">
</div>
<div class="field">
<label>Группа</label>
<input type='text' id='id_group9' hidden='hidden'>
<input type='text' id='group9' maxlength="20"    placeholder="Введите группу студента" title="Начните печатать, появятся варианты из которых нужно выбрать..">
</div>
<div class="field">
<label>Студент</label>
<input type='text' id='id_man9' hidden='hidden'>
<input type='text' id='name9' hidden='hidden'>
<input type='text' id='otch9' hidden='hidden'>
<input type='text' id='student9'  placeholder="Введите студента" title="Начните печатать фамилию студента, появятся варианты из которых нужно выбрать.">
</div>
<div title="Очистить поля" class='cross'></div>
</div>
<div class="sumbitfrom">
<div class="add"  title="Добавить дополнительную  форму">+</div>
<div class="remove"  title="Удалить дополнительную форму">-</div>
<button type="submit">Отправить</button>
</div>
</form>   
</div>
</div>
<script src="markunit/markunit6.js"></script>
<script src="../scripts/jqgrid/js/grid.locale-ru.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/js/jquery.jqGrid.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/ui.multiselect.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/jquery.searchFilter.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/jquery.tablednd.js" type="text/javascript"></script>
<script src="../scripts/tooltip.js"></script>
</body>
</html>
