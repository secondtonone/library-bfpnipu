<?php
require_once '../../scripts/startsession.php';
require_once '../../scripts/connect.php';


error_reporting(0); // Выключаем показ ошибок. Чтобы их видеть - вместо 0 поставьте E_ALL
// подключаемся к БД переделка через ПДО


$max_file_size = 5; // Максимальный размер файла в МегаБайтах
if($_POST['update']=='ok')
{
    // СТАРТ Загрузка файла на сервер
    if($_FILES["filename"]["size"] > $max_file_size*1024*1024)
    {
        echo 'The SIZE of File is more than '.$max_file_size.' Mb!';
        include('file_upload.php');
        exit;
    }
    if(copy($_FILES["filename"]["tmp_name"],$path.$_FILES["filename"]["name"]))
    {
        echo("The file "."<b>".$_FILES["filename"]["name"]."</b>"." was downloaded successfully!");
    }
    else
    {
        echo 'Error of Uploading';
        include('file_upload.php');
        exit;
    }
    setlocale(LC_ALL, 'en_US.utf8'); // Определяем параметры локали
    if(setlocale(LC_ALL, 0) == 'C') die('Your server does not suport LOCALS');

    $file = fopen('php://memory', 'w+');
    fwrite($file, iconv('CP1251', 'UTF-8', file_get_contents($_FILES["filename"]["name"])));
    rewind($file);

    mysql_query("TRUNCATE TABLE `table_to_import`"); // Очистка старой таблицы

    $r = 0; // это строки в файле
    while (($row = fgetcsv($file, 1000, ",")) != FALSE)  // $file - имя файла; 1000 - длина; ,(запятая) - это разделитель полей
    {
        $r++;
        //if($r == 1) {continue;} // Не дает записать в БД первую строку (бывает так, что первая строка используется для заголовков)
        $ins="INSERT INTO `table_to_import` (`id`, `price`, `name`) VALUES ('$row[0]', '$row[1]', '$row[2]')";
        mysql_query($ins);
        echo mysql_errno() . ": " . mysql_error(); // это вывод результата. если че, то можно закоментить
    }
    fclose($file);
}
else
{
    include('file_upload.php');
}
?>