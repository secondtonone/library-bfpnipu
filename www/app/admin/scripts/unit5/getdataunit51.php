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
                $allowedFields = array('year_postup', 'name_group', 'form', 'kolvo_studentov','kod_kafedri','vipusk','name_spec','year_okonchan');
                $allowedOperations = array('AND', 'OR');
                
                $searchData = json_decode($_POST['filters']);

                $qWhere = ' WHERE ';
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
    $rows = $dbh->query('SELECT COUNT(`id_group`) AS count FROM `group`');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT `id_group`, `year_postup`, `name_group`, `form`, `kolvo_studentov`,`kod_kafedri`,`vipusk`,s.`id_spec`,`name_spec`, `year_okonchan` FROM `group` g INNER JOIN `specialistic` s ON s.`id_spec`=g.`id_specialistic` INNER JOIN `kafedra` k ON s.`kod_kafedri`=k.`id_kafedra`'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
        $res->execute(array());

    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
    $response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

    $i=0;
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		$response->rows[$i]['id']=$row['id_group'];
        $response->rows[$i]['cell']=array($row['id_group'],$row['year_postup'],$row['name_group'],$row['form'],$row['kolvo_studentov'],$row['kod_kafedri'],$row['vipusk'],$row['id_spec'],$row['name_spec'],$row['year_okonchan']);
           
        $i++;}
   
    echo json_encode($response);
	}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>
