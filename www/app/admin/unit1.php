<?php require_once '../scripts/startsession.php';?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link href="../../css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="screen" href="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../scripts/jqgrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../scripts/jqgrid/plugins/ui.multiselect.css" />
<script type="text/javascript" src="../scripts/jqgrid/js/jquery-1.9.0.min.js"></script>
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
 
<script src="markunit/markunit1.js"></script>
<script src="../scripts/jqgrid/js/grid.locale-ru.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/themes/jquery-ui-1.9.2.custom.min.js" type="text/javascript"></script>
<script src="../scripts/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
</body>
</html>