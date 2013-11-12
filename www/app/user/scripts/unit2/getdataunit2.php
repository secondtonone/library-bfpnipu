<?php
session_start();
require_once('../../../scripts/connect.php');
try {
    //читаем параметры
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];


	$qWhere = '';
	//определяем команду (поиск или просто запрос на вывод данных)
	//если поиск, конструируем WHERE часть запроса
	

	if (isset($_POST['_search']) && $_POST['_search'] == 'true') {
		$allowedFields = array('name_book','year_create', 'data_vidachi', 'data_vozvrata', 'na_rukah', 'poterya', 'primechanie');
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
	$id_man=$_SESSION["id_man"];
    $rows = $dbh->prepare('SELECT COUNT(`id_vid`) AS count FROM `vidacha` WHERE `id_man`=?');
    $rows->execute(array($id_man));
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	

	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT `id_vid`, b.`name_book`,b.`year_create`, `data_vidachi`, `data_vozvrata`, `na_rukah`, `poterya`, `primechanie` FROM `vidacha` v INNER JOIN `people` p ON v.`id_man`=p.`id_man` JOIN `student` s ON s.`id_man`=p.`id_man` JOIN `group` g ON s.`id_group`=g.`id_group` JOIN `book` b ON v.`id_book`=b.`id_book` WHERE v.`id_man`=? AND v.`na_rukah`=?'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($id_man,"Yes"));

    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$response->rows[$i]['id']=$row['id_vid'];
        $response->rows[$i]['cell']=array($row['id_vid'],$row['name_book'],$row['year_create'],$row['data_vidachi'],$row['data_vozvrata'],$row['na_rukah'],$row['poterya'],$row['primechanie']);
		      $i++;
    }
    echo json_encode($response);
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>