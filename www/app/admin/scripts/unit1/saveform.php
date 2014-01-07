<?php
session_start();
require_once('../../../scripts/connect.php');

    $datevid = date("Y-m-d H:i:s");
    $id_book = $_POST['id_book'];
    $id_man = $_POST['id_man'];
    $i = $_POST['i'];   
    
try {
	if ($i==0){
        if (!empty($id_book) && !empty($id_man))
        { 
		$query=$dbh->prepare('SELECT `name_book`,`kolvo_vsego`,`ostatok` FROM `book` WHERE `id_book`=?' );
		$query->execute(array($id_book));
		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		if ($row['kolvo_vsego']==0)
		{echo '"'.$row['name_book'].'" не выдается в связи потери актуальности.';
		exit;
		}
			if ($row['ostatok']==0)
		{echo 'В данный момент нет экземляров "'.$row['name_book'].'".';
		exit;}
		
        $vid = $dbh->prepare('INSERT INTO `vidacha`(`id_man`,`id_book`,`data_vidachi`,`na_rukah`,`poterya`) VALUES (?,?,?,?,?)');
        $vid->execute(array($id_man,$id_book,$datevid,"Yes","No"));
        $ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`-? WHERE `id_book` =?');
        $ost->execute(array(1,$id_book ));
        echo "Запись добавлена!";
        }else{
        echo "Не заполнены строки в поле";
        exit;
        } 
	}else{
        for ($j=0;$j<=$i;$j++)
            {
        if ($j==0 && !empty($id_book) && !empty($id_man))
        { 
        $vid = $dbh->prepare('INSERT INTO `vidacha`(`id_man`,`id_book`,`data_vidachi`,`na_rukah`,`poterya`) VALUES (?,?,?,?,?)');
        $vid->execute(array($id_man,$id_book,$datevid,"Yes","No"));
        $ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`-? WHERE `id_book` =?');
        $ost->execute(array(1,$id_book ));
        }
		if ($j>0){
       if (!empty($_POST['id_book'.$j.'']) && !empty($_POST['id_man'.$j.'']))
        { 
        $id_book = $_POST['id_book'.$j.''];
        $id_man = $_POST['id_man'.$j.''];  
		
        $vid = $dbh->prepare('INSERT INTO `vidacha`(`id_man`,`id_book`,`data_vidachi`,`na_rukah`,`poterya`) VALUES (?,?,?,?,?)');
        $vid->execute(array($id_man,$id_book,$datevid,"Yes","No"));
		
        $ost = $dbh->prepare('UPDATE `book` SET `ostatok`=`ostatok`-? WHERE `id_book` =?');
        $ost->execute(array(1,$id_book ));
        }else{
           echo "Не заполнены строки в поле";
           exit; 
        }
        }
        }
		echo "Записи добавлены";
}
      
}  
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}

?>
