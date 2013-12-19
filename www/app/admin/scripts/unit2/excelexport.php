<?php
session_start();
require_once('../../../scripts/connect.php');

	
try {

     function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }


    $filename = "website_data_" . date('Ymd') . ".xls";
    header("Content-Encoding:UTF-8");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
	
    $flag = false;
	
    $curPage = $_GET['page'];
    $rowsPerPage = $_GET['rows'];
    $sortingField = $_GET['sidx'];
    $sortingOrder = $_GET['sord'];


	$qWhere = '';
	//определяем команду (поиск или просто запрос на вывод данных)
	//если поиск, конструируем WHERE часть запроса
	

	if (isset($_GET['_search']) && $_GET['_search'] == 'true') {
		$allowedFields = array('fam','name','otchestvo', 'name_group', 'name_book','year_create', 'data_vidachi', 'data_vozvrata', 'na_rukah', 'poterya', 'primechanie');
		$allowedOperations = array('AND', 'OR');
		
		$searchData = json_decode($_GET['filters']);

		$qWhere = ' AND ';
		$firstElem = true;

		//объединяем все полученные условия
		foreach ($searchData->rules as $rule) {
			if (!$firstElem) {
				//объединяем условия (с помощью AND или OR)
				if (in_array($searchData->groupOp, $allowedOperations)) {
					$qWhere .= ' '.$searchData->groupOp.' ';
				}
				else {
					//если получили не существующее условие - возвращаем описание ошибки
					throw new Exception('Cool hacker is here!!! :)');
				}
			}
			else {
				$firstElem = false;
			}
			
			//вставляем условия
			if (in_array($rule->field, $allowedFields)) {
				switch ($rule->op) {
					case 'eq': $qWhere .= $rule->field.' = '.$dbh->quote($rule->data); break;
					case 'ne': $qWhere .= $rule->field.' <> '.$dbh->quote($rule->data); break;
					case 'bw': $qWhere .= $rule->field.' LIKE '.$dbh->quote($rule->data.'%'); break;
					case 'cn': $qWhere .= $rule->field.' LIKE '.$dbh->quote('%'.$rule->data.'%'); break;
					default: throw new Exception('Cool hacker is here!!! :)');
				}
			}
			else {
				//если получили не существующее условие - возвращаем описание ошибки
				throw new Exception('Cool hacker is here!!! :)');
			}
		}
	}
	
    //определяем количество записей в таблице
    $rows = $dbh->query('SELECT COUNT(`id_vid`) AS count FROM `vidacha`');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	
    $kodkaf=$_SESSION["id_kafedra"];
	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT `id_vid`, p.`fam`,p.`name`,p.`otchestvo`, g.`name_group`, b.`name_book`,b.`year_create`, `data_vidachi`, `data_vozvrata`, `na_rukah`, `poterya`, `primechanie` FROM `vidacha` v INNER JOIN `people` p ON v.`id_man`=p.`id_man` JOIN `student` s ON s.`id_man`=p.`id_man` JOIN `group` g ON s.`id_group`=g.`id_group` JOIN `book` b ON v.`id_book`=b.`id_book` WHERE b.`id_kafedra`=?'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($kodkaf));
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];


    while(false !==($row=$res->fetch(PDO::FETCH_ASSOC))) {
		
          if(!$flag) {
          echo implode("\t", array_keys($row)) . "\r\n";
          $flag = true;
                    }
     array_walk($row, 'cleanData');
     echo implode("\t", array_values($row)) . "\r\n";
                }
                exit;
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>