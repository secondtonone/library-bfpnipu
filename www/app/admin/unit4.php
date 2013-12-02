<?php require_once '../scripts/startsession.php';?>
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
   <div class="table">
    <table id="list"></table> 
        <div id="pager"></div> 
    </div>
</div>
</div>
<script src="markunit/markunit4.js"></script>
<script src="../scripts/jqgrid/js/grid.locale-ru.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/js/jquery.jqGrid.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/ui.multiselect.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/jquery.searchFilter.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/plugins/jquery.tablednd.js" type="text/javascript"></script>
<script src="../scripts/tooltip.js"></script>
</body>
</html>
