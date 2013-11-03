<?php
session_start();
require_once('../../scripts/connect.php');
require_once('../../scripts/startsession.php');
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
		$allowedFields = array('namebook','avtor','avtor2','yearcreate','disciplina','bookcount','allcount','nazkaf_krat','udk', 'bbk', 'isbn','annotation','nazkaf_krat');
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
    //получаем список пользователей из базы
    $res = $dbh->prepare('SELECT book.id,book.namebook,(select fam from teacher where book.avtor=teacher.id_man) as fam,avtor,avtor2,book.udk,book.bbk,book.isbn,book.yearcreate,(SELECT disciplina.nazvan FROM disciplina WHERE book.disciplina=disciplina.id) as disciplina,book.annotation,book.bookcount,book.allcount,kafedra.nazkaf_krat FROM `book`,`kafedra` WHERE book.kod_kaf=kafedra.kod_kaf AND book.kod_kaf=? '.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($kod));
	
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $response->rows[$i]['id']=$row['id'];
        $response->rows[$i]['cell']=array($row['id'],$row['namebook'], $row['avtor'],$row['avtor2'],$row['yearcreate'], $row['disciplina'],$row['bookcount'],$row['allcount'],$row['nazkaf_krat'], $row['udk'],$row['bbk'],$row['isbn'],$row['annotation']);
        $i++;
    }
    echo json_encode($response);
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

// end of getdata.php