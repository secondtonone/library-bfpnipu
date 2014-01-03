<?php
session_start();
require_once('../../../scripts/connect.php');
try { 
    $q=$_GET["q"];
	$response=array();
	$term=$_GET["term"];
		
	if ($q==1){
      $res = $dbh->prepare("SELECT `id_group`,`name_group` FROM `group` WHERE `name_group` LIKE ?");
	$res->execute(array("%$term%"));

    
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		         $response[]=array('value' => $row["id_group"],'label' =>$row["name_group"]);
	    }
    echo json_encode($response);
	}
if ($q==2){
			$res = $dbh->prepare("SELECT `id_spec`,`name_spec` FROM `specialistic` WHERE `name_spec` LIKE ?");

	$res->execute(array("%$term%"));

    
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		        $response[]=array('value' => $row["id_spec"],'label' =>$row["name_spec"]);
	    }
    echo json_encode($response);
	}
	
}
catch (Exception $e) {
    echo json_encode(array('errMess'=>'Error: '.$e->getMessage()));
}

?>