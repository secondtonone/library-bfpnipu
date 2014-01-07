<?php
session_start();
require_once('../../../scripts/connect.php');


	
try {

   	
    $curPage = $_GET['page'];
    $rowsPerPage = $_GET['rows'];
    $sortingField = $_GET['sidx'];
    $sortingOrder = $_GET['sord'];


	$qWhere = '';
	//определяем команду (поиск или просто запрос на вывод данных)
	//если поиск, конструируем WHERE часть запроса
	

	if (isset($_GET['_search']) && $_GET['_search'] == 'true') {
	$allowedFields = array('year_postup', 'name_group', 'form', 'kolvo_studentov','kod_kafedri','name_spec','year_okonchan');
		$allowedOperations = array('AND', 'OR');
		
		$searchData = json_decode($_GET['filters']);

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
    $res = $dbh->prepare('SELECT `id_group`, `year_postup`, `name_group`, `form`, `kolvo_studentov`,`name_kafedra`,s.`id_spec`,`name_spec`, `year_okonchan` FROM `group` g INNER JOIN `specialistic` s ON s.`id_spec`=g.`id_specialistic` INNER JOIN `kafedra` k ON s.`kod_kafedri`=k.`id_kafedra`'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array());
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

  $filename = "Данные о группах " . date('Y-m-d') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>';
 echo '<table width="700" border="1"> 
  <tr>
    <td>№</td> 
    <td>Год поступления</td> 
    <td>Название группы</td>
	<td>Форма</td> 
	<td>Кол-во студентов</td> 
	<td>Кафедра</td>
	<td>Специальность</td> 
	<td>Год окончания</td> 
  </tr>';
  while($row = $res->fetch(PDO::FETCH_ASSOC)) {
 echo  '<tr> 
    <td>'.$row["id_group"].'</td> 
    <td>'.$row['year_postup'].'</td> 
    <td>'.$row['name_group'].'</td> 
    <td>'.$row['form'].'</td> 
    <td>'.$row['kolvo_studentov'].'</td> 
	<td>'.$row['name_kafedra'].'</td> 
    <td>'.$row['name_spec'].'</td> 
    <td>'.$row['year_okonchan'].'</td> 
      </tr>';
 }
 echo '</table>';

}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>