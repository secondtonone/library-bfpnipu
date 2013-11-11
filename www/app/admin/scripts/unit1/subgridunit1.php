<?php
session_start();
require_once('../../../scripts/connect.php');	
    $id = $_GET['id'];

	$res = $dbh->prepare('SELECT a.`fam_io` FROM `book` as b INNER JOIN napisal as n ON b.`id_book`=n.`id_book` JOIN `avtor` as a ON n.`id_avtor`=a.`id_avtor` WHERE b.`id_book`=?');
	
	$res->execute(array($id));

    $i=0;
	$response = new stdClass();
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		
        $response->rows[$i]['cell']=array($row['fam_io']);
		$i++;
    }
    echo json_encode($response);
		
?>