<?php
session_start();
require_once '../../scripts/startsession.php';
require_once '../../scripts/connect.php';

try {

$max_file_size = 5; // Максимальный размер файла в МегаБайтах
if($_POST['update']=='ok')
{
    // СТАРТ Загрузка файла на сервер
    if($_FILES["filename"]["size"] > $max_file_size*1024*1024)
    {
        echo 'Размер файла больше '.$max_file_size.' Mb!';
        exit;
    }
    if(copy($_FILES["filename"]["tmp_name"],$path.$_FILES["filename"]["name"]))
    {
        echo("Файл".$_FILES["filename"]["name"]."успешно отправлен!");
    }
    else
    {
        echo 'Ошибка при отправке файла';
        exit;
    }
    setlocale(LC_ALL, 'en_US.utf8'); // Определяем параметры локали
    if(setlocale(LC_ALL, 0) == 'C'){
        exit;
        }
    $file = fopen('php://memory', 'w+');
    fwrite($file, iconv('CP1251', 'UTF-8', file_get_contents($_FILES["filename"]["name"])));
    rewind($file);

    $r = 0; // это строки в файле
    while (($row = fgetcsv($file, 1000, ",")) != FALSE)  // $file - имя файла; 1000 - длина; ,(запятая) - это разделитель полей
    {
        $r++;
        //if($r == 1) {continue;} // Не дает записать в БД первую строку (бывает так, что первая строка используется для заголовков)
        
        
        $ins=$dbh->prepare('INSERT INTO `table_to_import` (`id`, `price`, `name`) VALUES (?,?,?)');
        $ins->execute(array($row[0],$row[1],$row[2]));
        }
    fclose($file);
}

}  
catch (PDOException $e) {
    echo 'Database error: '.$e->getMessage();
}
?>
