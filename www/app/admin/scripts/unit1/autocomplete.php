<?php
session_start();
require_once('../../../scripts/connect.php');
try { 
    $id_q=$_GET["id_q"];
	$response=array();
	$term=$_GET["term"];
    $kodkaf=$_SESSION["id_kafedra"];
		
	if ($id_q==1){
      $res = $dbh->prepare("SELECT b.`id_book`,b.`name_book` FROM `book` as b INNER JOIN `kafedra` as k ON k.`id_kafedra`=b.`id_kafedra` WHERE b.`id_kafedra`=? AND b.`name_book` LIKE ?");
	$res->execute(array($kodkaf,"%$term%"));

    
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		        $response[]=array('value' => $row["id_book"],'label' =>$row["name_book"]);
	    }
    echo json_encode($response);
	}
		if ($id_q==2){
			$res = $dbh->prepare("SELECT `id_group`,`name_group` FROM `group` WHERE `name_group` LIKE ?");

	$res->execute(array("%$term%"));

    
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		        $response[]=array('value' => $row["id_group"],'label' =>$row["name_group"]);
	    }
    echo json_encode($response);
	}
			if ($id_q==3){
				
			$id_group=$_GET["id_group"]; 
			
			$res = $dbh->prepare("SELECT p.`id_man`, p.`fam`,p.`name`,p.`otchestvo` FROM  `people` p INNER JOIN `student` s ON s.`id_man`=p.`id_man` WHERE s.`id_group`=? AND p.`fam` LIKE ?");

	$res->execute(array($id_group,"%$term%"));

    
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		        $response[]=array('value' => $row["id_man"],'label' =>$row["fam"],'name' =>$row["name"],'otch'=>$row["otchestvo"]);
	    }
    echo json_encode($response);
	}

}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>