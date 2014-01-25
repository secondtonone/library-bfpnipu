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
		$allowedFields = array('name_book','year_create','izdatelstvo','kolvo_str','kolvo_vsego','UDK','name_kratko','ostatok');
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
   $rows = $dbh->query('SELECT COUNT(id_book) AS count FROM book');
    $totalRows = $rows->fetch(PDO::FETCH_ASSOC);
	
    $kodkaf=$_SESSION["id_kafedra"];
	
    $firstRowIndex = $curPage * $rowsPerPage - $rowsPerPage;
    //получаем список из базы
    $res = $dbh->prepare('SELECT b.`id_book`,b.`name_book`,v.`izdatelstvo`,b.`kolvo_str`,b.`year_create`, b.`kolvo_vsego`, b.`UDK`, k.`name_kafedra`, b.`ostatok`FROM `book` as b INNER JOIN `kafedra` as k ON k.`id_kafedra`=b.`id_kafedra` INNER JOIN `vid_izdatelstva` v ON v.`kod_izdatelstva`=b.`kod_izdat` WHERE b.`id_kafedra`=?'.$qWhere.' ORDER BY '.$sortingField.' '.$sortingOrder.' LIMIT '.$firstRowIndex.', '.$rowsPerPage);
	$res->execute(array($kodkaf));
    //сохраняем номер текущей страницы, общее количество страниц и общее количество записей
	$response = new stdClass();
    $response->page = $curPage;
    $response->total = ceil($totalRows['count'] / $rowsPerPage);
    $response->records = $totalRows['count'];

  $filename = "Данные о книгах " . date('Y-m-d') . ".xls";

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
    <td>Название книги</td> 
	<td>Издательство</td> 
    <td>Кол-во страниц</td>
	<td>Год издания</td> 
	<td>Тираж</td> 
	<td>УДК</td>
	<td>Кафедра</td> 
	<td>Остаток</td> 
  </tr>';
  while($row = $res->fetch(PDO::FETCH_ASSOC)) {
echo  '<tr> 
    <td>'.$row['id_book'].'</td> 
    <td>'.$row["name_book"].'</td> 
    <td>'.$row["izdatelstvo"].'</td> 
	<td>'.$row["kolvo_str"].'</td> 
	<td>'.$row["year_create"].'</td> 
    <td>'.$row["kolvo_vsego"].'</td> 
    <td>'.$row['UDK'].'</td> 
	<td>'.$row['name_kafedra'].'</td> 
    <td>'.$row['ostatok'].'</td> 
          </tr>';
 }
 echo '</table>';
}
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>