<?php
session_start();
require_once('../../../scripts/connect.php');
try {
    //читаем параметры
    $curPage = $_POST['page'];
    $rowsPerPage = $_POST['rows'];
    $sortingField = $_POST['sidx'];
    $sortingOrder = $_POST['sord'];
    $idgroup='';
	if (isset($_GET['idgroup']) && !empty($_GET['idgroup'])) {
    $idgroup=$_GET['idgroup'];
  }

	$qWhere = '';
	//определяем команду (поиск или просто запрос на вывод данных)
	//если поиск, конструируем WHERE часть запроса
	

	if (isset($_POST['_search']) && $_POST['_search'] == 'true') {
		$allowedFields = array('fam','name','otchestvo','e_mail');
		$allowedOperations = array('AND', 'OR');
		
		$searchData = json_decode($_POST['filters']);

		$qWhere = ' AND ';
		if (isset($_GET['idgroup']) && !empty($_GET['idgroup'])) {
        $qWhere = ' WHERE ';
        }
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
	if (empty($idgroup)) {
     $rows = $dbh->query('SELECT COUNT(id_man) AS count FROM student');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC); }else
	{$rows = $dbh->prepare('SELECT COUNT(id_man) AS count FROM student WHERE id_group=?');
	$rows->execute(array($idgroup));
	$totalRows = $rows->fetch(PDO::FETCH_ASSOC);
		}

	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
	if (empty($idgroup)) {
    $res = $dbh->prepare('SELECT s.`id_man`, `fam`, `name`, `otchestvo`,`e_mail` FROM `student` as s INNER JOIN `people` as p ON s.`id_man`=p.`id_man` INNER JOIN `group` as g ON s.`id_group`=g.`id_group`'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array());
	}else {
		$res = $dbh->prepare('SELECT s.`id_man`, `fam`, `name`, `otchestvo`,`e_mail` FROM `student` as s INNER JOIN `people` as p ON s.`id_man`=p.`id_man` INNER JOIN `group` as g ON s.`id_group`=g.`id_group` WHERE s.`id_group`=?'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($idgroup));
		}
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$response->rows[$i]['id']=$row['id_man'];
        $response->rows[$i]['cell']=array($row['id_man'],$row['fam'],$row['name'],$row['otchestvo'],$row['e_mail']);
		
        $i++;
    }
    echo json_encode($response);
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>