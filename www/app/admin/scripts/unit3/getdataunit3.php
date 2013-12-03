<?php
session_start();
require_once('../../../scripts/connect.php');
try {
    if ($_GET['n']==1){	
    //читаем параметры
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];


	$qWhere = '';
	//определяем команду (поиск или просто запрос на вывод данных)
	//если поиск, конструируем WHERE часть запроса
	

	if (isset($_POST['_search']) && $_POST['_search'] == 'true') {
		$allowedFields = array('name_book','year_create','kolvo_vsego','UDK', 'name_kratko','ostatok');
		$allowedOperations = array('AND', 'OR');
		
		$searchData = json_decode($_POST['filters']);

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
    $rows = $dbh->query('SELECT COUNT(id_book) AS count FROM book');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	
    $kodkaf=$_SESSION["id_kafedra"];
    $year = date('Y')-5; 
	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT b.`id_book`,b.`name_book`,b.`year_create`, b.`kolvo_vsego`, b.`UDK`, k.`name_kratko`, b.`ostatok`FROM `book` as b INNER JOIN `kafedra` as k ON k.`id_kafedra`=b.`id_kafedra` WHERE b.`id_kafedra`=? AND b.`year_create`<=?'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($kodkaf,$year));

    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
    $response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$response->rows[$i]['id']=$row['id_book'];
        $response->rows[$i]['cell']=array($row['id_book'],$row['name_book'],$row['year_create'],$row['kolvo_vsego'],$row['UDK'], $row['name_kratko'],$row['ostatok']);
		
        $i++;
    }
    echo json_encode($response);}
    if ($_GET['n']==2){	
    //читаем параметры
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];


	$qWhere = '';
	//определяем команду (поиск или просто запрос на вывод данных)
	//если поиск, конструируем WHERE часть запроса
	

	if (isset($_POST['_search']) && $_POST['_search'] == 'true') {
		$allowedFields = array('name_book','year_create','kolvo_vsego','UDK', 'name_kratko','ostatok');
		$allowedOperations = array('AND', 'OR');
		
		$searchData = json_decode($_POST['filters']);

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
    $rows = $dbh->query('SELECT COUNT(id_book) AS count FROM book');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	
    $kodkaf=$_SESSION["id_kafedra"];

	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT b.`id_book`,b.`name_book`,b.`year_create`, b.`kolvo_vsego`, b.`ostatok`,COUNT(v.`id_book`) as narukah,v.`data_vidachi` FROM `book` as b INNER JOIN `kafedra` as k ON k.`id_kafedra`=b.`id_kafedra` JOIN `vidacha` as v ON b.`id_book`=v.`id_book` WHERE b.`id_kafedra`=? AND v.`na_rukah`=?'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($kodkaf,"Yes"));

    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
    $response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    	 list($year, $month, $day, $hour, $minute, $second) = sscanf($row['data_vidachi'], "%04s-%02s-%02s %02s:%02s:%02s");
                $raz=$curyear-$year;
                if (($raz>1) or ($month<=11 and $raz==1 and $curmonth>5) or ($raz==0 and $curmonth>6 and $month<=5)){
	$response->rows[$i]['id']=$row['id_book'];
        $response->rows[$i]['cell']=array($row['id_book'],$row['name_book'],$row['year_create'],$row['kolvo_vsego'],$row['ostatok']);
		
        $i++;
    }
    echo json_encode($response);}}
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>
