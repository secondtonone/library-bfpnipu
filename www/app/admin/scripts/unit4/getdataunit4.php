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
		$allowedFields = array('mail','fam','name','otchestvo','name_group','titles','mark', 'date_change');
		$allowedOperations = array('AND', 'OR');
		
		$searchData = json_decode($_POST['filters']);

		$qWhere = 'WHERE';
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
    $rows = $dbh->query('SELECT COUNT(id_mail) AS count FROM mail');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	
	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT `id_mail`,`fam`,`name`,`otchestvo`,`name_group`,`mail`,`titles`,`mark`,`date_change` FROM `mail` m INNER JOIN `people` p ON m.`id_man`=p.`id_man` JOIN `student` s ON p.`id_man`=s.`id_man` JOIN `group` g ON s.`id_group`=g.`id_group`'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute();

    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$response->rows[$i]['id']=$row['id_mail'];
        $response->rows[$i]['cell']=array($row['id_mail'],$row['mail'],$row['fam'],$row['name'],$row['otchestvo'],$row['name_group'],$row['titles'],$row['mark'],$row['date_change']);
        $i++;
    }
    echo json_encode($response);
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>