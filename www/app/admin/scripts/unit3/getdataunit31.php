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
                $allowedFields = array('name_book','year_create','kolvo_vsego','ostatok','na_rukah');
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
        $res = $dbh->prepare('SELECT book.`id_book`,`name_book`,`year_create`,`kolvo_vsego`,`ostatok`,COUNT(`na_rukah`)as na_rukah from `book` INNER JOIN `vidacha` ON book.`id_book`=vidacha.`id_book`  AND book.`id_kafedra`=? where `na_rukah`="Yes" AND `poterya`="No" AND ((YEAR(CURDATE())-YEAR(data_vidachi)>=1) OR (YEAR(CURDATE())-YEAR(`data_vidachi`)=1) OR (YEAR(CURDATE())-YEAR(data_vidachi)=0 AND MONTH(CURDATE())>6 AND MONTH(`data_vidachi`)<=5)) GROUP BY `book`.id_book'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
        $res->execute(array($kodkaf));

    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
    $response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$response->rows[$i]['id']=$row['id_book'];
        $response->rows[$i]['cell']=array($row['id_book'],$row['name_book'],$row['year_create'],$row['kolvo_vsego'],$row['ostatok'],$row['na_rukah']);
                
        $i++;}
   
    echo json_encode($response);
	}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>
