<?php
session_start();
require_once('../../../scripts/connect.php');

    $datevid = date("Y-m-d H:i:s");
    $id_book = $_GET['id_book'];
    $id_man = $_GET['id_man'];
    $i = $_GET['i'];   
    
try {
	if ($i==0){
        if (!empty($_GET['id_book']) && !empty($_GET['id_man']))
        { 
        $vid = $dbh->prepare('INSERT INTO `vidacha`(`id_man`,`id_book`,`data_vozvrata`,`na_rukah`,`poterya`) VALUES (?,?,?,?,?)');
        $vid->execute(array($id_man,$id_book,$datevid,"Yes","No"));
        $ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`-? WHERE `id_book` =?');
        $ost->execute(array(1,$id_book ));
        echo "Запись добавлена!";
        }else{
        echo "Не заполнены строки в поле";
        exit;
        } 
	}else{
        for ($j=1;$j<=$i;$j++)
            {
        if (!empty($_GET['id_book'.$j.'']) && !empty($_GET['id_man'.$j.'']))
        { 
        $id_book = $_GET['id_book'.$j.''];
        $id_man = $_GET['id_man'.$j.''];  
		
        $vid = $dbh->prepare('INSERT INTO `vidacha`(`id_man`,`id_book`,`data_vozvrata`,`na_rukah`,`poterya`) VALUES (?,?,?,?,?)');
        $vid->execute(array($id_man,$id_book,$datevid,"Yes","No"));
		
        $ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`-? WHERE `id_book` =?');
        $ost->execute(array(1,$id_book ));
        }else{
           echo "Не заполнены строки в поле";
           exit; 
        }
        }
        echo "Записи добавлены";
        }
      
}  
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>
