<?php   
/*
 * Скрипт для смены данных студента им самим
 */
 include_once 'soed.php';
  $one25 = mysql_real_escape_string($_POST['domnumber']); 
  $one26 = mysql_real_escape_string($_POST['sotnumber']);
  $one27 = mysql_real_escape_string($_POST['email']); 
  $one28 = mysql_real_escape_string($_POST['wplace']);
  $one29 = mysql_real_escape_string($_POST['wplace1']); 
  $one30 = mysql_real_escape_string($_POST['dol']);
  $one31 = mysql_real_escape_string($_POST['rabnumber']); 
  $query1 = "UPDATE `student` SET number_dom='$one25', number_sot='$one26', e_mail='$one27', placework='$one28', otdel='$one29', dolg='$one30', number_rab='$one31'";  
  mysql_query($query1) or die(mysql_error());
  mysql_close();
  echo ("<div style=\"text-align: center; margin-top: 10px;\">
<font color=\"navy\">Данные успешно сохранены!</font>");
echo "<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>";
?>