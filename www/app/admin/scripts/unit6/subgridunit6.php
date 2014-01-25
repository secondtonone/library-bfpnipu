<?php
session_start();
require_once('../../../scripts/connect.php');	
	if (!empty($_GET['id'])){
		$id = $_GET['id'];
	$res = $dbh->prepare('SELECT a.`id_avtor`,a.`fam_io` FROM `book` as b INNER JOIN napisal as n ON b.`id_book`=n.`id_book` JOIN `avtor` as a ON n.`id_avtor`=a.`id_avtor` WHERE b.`id_book`=?');
	
	$res->execute(array($id));

    $i=0;
	$response = new stdClass();
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
	    $response->rows[$i]['cell']=array($row['id_avtor'],$row['fam_io']);
		$i++;
    }
    echo json_encode($response);
	}
	if(!empty($_GET['q'])){
		$term=$_GET["term"];
		$response=array();
		$res = $dbh->prepare('SELECT a.`id_avtor`,a.`fam_io` FROM `avtor` as a  WHERE a.`fam_io` LIKE ?');
	
	$res->execute(array("%$term%"));

      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		        $response[]=array('value' => $row["id_avtor"],'label' =>$row["fam_io"]);
	    }
    echo json_encode($response);
		}
?>