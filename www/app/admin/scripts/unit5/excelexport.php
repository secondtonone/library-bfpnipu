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
		$allowedFields = array('fam','name','otchestvo', 'name_group','god_postup','number_zach','telefon_dom','telefon_sot','e_mail','mesto_raboti','ceh_otdel','doljnost','telefon_rabochii');
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
    $rows = $dbh->query('SELECT COUNT(id_man) AS count FROM `student`');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	

	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT s.`id_man`, `fam`, `name`, `otchestvo`,g.`id_group`,g.`name_group`,`god_postup`,`number_zach` ,`telefon_dom`, `telefon_sot`, `e_mail`, `mesto_raboti`, `ceh_otdel`, `doljnost`, `telefon_rabochii`,p.`data_change` FROM `student` as s INNER JOIN `people` as p ON s.`id_man`=p.`id_man` INNER JOIN `group` as g ON s.`id_group`=g.`id_group`'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array());
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

  $filename = "Данные о студентах " . date('Y-m-d') . ".xls";

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
    <td>Фамилия</td> 
	<td>Имя</td> 
    <td>Отчество</td>
	<td>Группа</td> 
	<td>Год поступления</td> 
	<td>Номер зачетки</td>
	<td>Дом. телефон</td> 
	<td>Сот. телефон</td> 
	<td>Эл. почта</td>
	<td>Место работы</td>
	<td>Цех, отдел</td>
	<td>Должность</td>
	<td>Рабочий телефон</td>
	<td>Дата</td>
  </tr>';
  while($row = $res->fetch(PDO::FETCH_ASSOC)) {
echo  '<tr> 
    <td>'.$row['id_man'].'</td> 
    <td>'.$row["fam"].'</td> 
    <td>'.$row["name"].'</td> 
	<td>'.$row["otchestvo"].'</td> 
	<td>'.$row["name_group"].'</td> 
    <td>'.$row["god_postup"].'</td> 
    <td>'.$row['number_zach'].'</td> 
	<td>'.$row['telefon_dom'].'</td> 
    <td>'.$row['telefon_sot'].'</td> 
    <td>'.$row['e_mail'].'</td> 
    <td>'.$row['mesto_raboti'].'</td> 
    <td>'.$row['ceh_otdel'].'</td> 
	<td>'.$row['doljnost'].'</td> 
	<td>'.$row['telefon_rabochii'].'</td> 
	<td>'.$row['data_change'].'</td> 
      </tr>';
 }
 echo '</table>';
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>