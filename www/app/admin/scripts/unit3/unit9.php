<?php
session_start();
if(isset($_SESSION["id"])and($_SESSION["id"]!=='')and($_SESSION["right"]=='Moderator')){
echo "<h3>Привет, ".$_SESSION["name"]."!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='unit7.php'>Помощь</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='/../reg/exitad.php'>Выйти</a></h3><br />";
}else{
echo "<html><head><meta http-equiv='Refresh' content='0; URL=/../reg/indexad.php'></head></html>";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Электронная библиотека кафедр БФ ПНИПУ</title>
<link rel="stylesheet" type="text/css" href="rules.css">
<script type="text/javascript" src="jquery.js"></script>

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--></head>

<body>
<?php include_once '../header.php'; ?>
<div class="block">
    <nav> 
 <div class="menu-item">
      <h4><a href="index.html" id="getContent8">Главная</a></h4>

    </div>
     
      <div class="menu-item">
      <h4><a href="#">Добавить</a></h4>
      <ul>
        <li><a href="unit1.php" id="getContent1">Студента</a></li>
        <li><a href="unit2.php"id="getContent2">Преподавателя</a></li>
          <li><a href="unit3.php" id="getContent3">Издание</a></li>
          <li><a href="unit4.php" id="getContent4">Группу</a></li>
      </ul>
    </div>
 
    <div class="menu-itemone">
      <h4><a href="#">Выдача и прием</a></h4>
      <ul>
        <li><a href="vidacha/index.html" id="getContent5">Выдача</a></li>
        <li><a href="priem/index.html" id="getContent9">Прием</a></li>
      </ul>
    </div>
 
     
                <div class="menu-itemone">
      <h4><a href="#">Статистика</a></h4>
      <ul>
        <li><a href="unit8.php" id="getContent10">По читателям</a></li>
        <li><a href="unit9.php" id="getContent6">По изданиям</a></li>
      </ul>
    </div>
</nav>
<div id="content"><section><h3>Эта литература устарела, требует замены:</h3>
<?php
include_once 'soed.php';
$year = date('Y'); 
$kod=$_SESSION["kod_kaf"];
$ath = mysql_query("SELECT namebook, avtor, yearcreate,allcount FROM `book` WHERE yearcreate <='$year' - '5' AND book.kod_kaf='$kod'");
if($ath)
{
  // Определяем таблицу и заголовок
  echo "<table id='box-table-a' summary='Устаревшие издания'>";
  echo  "<thead>";
    echo  "<tr>";
        	echo  "<th scope='col'>Название книги</th>";
            echo  "<th scope='col'>Автор</th>";
            echo  "<th scope='col'>Год издания</th>";
            echo  "<th scope='col'>Тираж</th>";
        echo  "</tr>";
    echo  "</thead>";
	 echo "<tbody>";
  // Так как запрос возвращает несколько строк, применяем цикл
  while($author = mysql_fetch_array($ath))
  {
    echo "<tr><td>".$author['namebook']."&nbsp;</td><td>".$author['avtor']."
    &nbsp </td><td>".$author['yearcreate']."&nbsp </td><td>".$author['allcount']."&nbsp </td></tr>";
  }
   echo "</table>";
     echo "</tbody>";
}
else
{
  echo "<p><b>Error: ".mysql_error()."</b><p>";
  exit();}
  ?>
  <br>
  <h3>Издания, требующие дополнительных экземпляров:</h3>
<?php
include_once 'soed.php';
$year = date('Y'); 
$kod=$_SESSION["kod_kaf"];
$ath = mysql_query("SELECT (select namebook from book where book.id=vidacha.id_book AND book.kod_kaf='$kod') as namebook,(select bookcount from book where book.id=vidacha.id_book) as bookcount, (select allcount from book where book.id=vidacha.id_book) as allcount, COUNT(narukah) as KOL FROM vidacha where narukah= 'Yes' AND ((MONTH(vidacha.date_vid) between 9 AND 12) AND YEAR(vidacha.date_vid)<YEAR(CURDATE())) OR ((MONTH(vidacha.date_vid) between 1 AND 6) AND (YEAR(vidacha.date_vid)<=YEAR(CURDATE()) AND MONTH(CURDATE())>=6 ))  GROUP BY id_book");
if($ath)
{
  // Определяем таблицу и заголовок
    echo "<table id='box-table-a' summary='Возврат изданий'>";
  echo  "<thead>";
    echo  "<tr>";
        	echo  "<th scope='col'>Название книги</th>";
            echo  "<th scope='col'>Осталось</th>";
            echo  "<th scope='col'>На руках более полугода</th>";
            echo  "<th scope='col'>Тираж</th>";
        echo  "</tr>";
    echo  "</thead>";
	 echo "<tbody>";
  // Так как запрос возвращает несколько строк, применяем цикл
  while($author = mysql_fetch_array($ath))
  {
	  $raz=$author['bookcount']+$author['KOL'];
	  $nado=$author['allcount']-$raz;
	  $nadot=20-$raz;
	  if ($raz<=20){
    echo "<tr><td>".$author['namebook']."
	</td><td>".$author['bookcount']."
     </td><td>".$author['KOL']."
    </td><td>".$author['allcount']."
     </td></tr>";}
  }
   echo "</table>";
     echo "</tbody>";
}
else
{
  echo "<p><b>Error: ".mysql_error()."</b><p>";
  exit();}
  ?>
  
</section>
</div>
</div>
</body>
</html>