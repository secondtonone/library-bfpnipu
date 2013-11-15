<?php
session_start();
require_once('../../../scripts/connect.php');	
    $id = $_GET['id'];
    $query = $_GET['q'];
	$i=0;
	
	$vid = $dbh->prepare('SELECT `id_man`,`id_book` FROM `vidacha` WHERE `id_vid`=?');
	$vid->execute(array($id));
	$resvid = $vid->fetch(PDO::FETCH_ASSOC);
	
	$count = $dbh->prepare('SELECT COUNT(`id_vid`) as count FROM `vidacha` WHERE `id_man`=? AND `na_rukah`=?');
	$count->execute(array($resvid['id_man'],"Yes"));
	$countres = $count->fetch(PDO::FETCH_ASSOC);
	
	
	
	if ($query==2) {		
	$res = $dbh->prepare('SELECT a.`fam_io`,b.`kolvo_vsego`,b.`ostatok` FROM `book` as b INNER JOIN napisal as n ON b.`id_book`=n.`id_book` JOIN `avtor` as a ON n.`id_avtor`=a.`id_avtor` WHERE b.`id_book`=?');
	
	$res->execute(array($resvid['id_book']));

    $i=0;
	$response = new stdClass();
    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
		if ($i<1){
        $response->rows[$i]['cell']=array($row['fam_io'],$row['kolvo_vsego'],$row['ostatok']);
		$i++;} 
		else {$response->rows[$i]['cell']=array($row['fam_io'],'-','-');
			
			}
    }
    echo json_encode($response); }
?>