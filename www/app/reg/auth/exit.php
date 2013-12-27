<?php
/*
 * Запускаем сессию
 */
session_start();
/*
 * Удаляем данные из сессии
 */
session_unset();
/*
 * Закрываем сессию
 */
session_destroy();

/*
 * Делаем редирект на главную страницу
 */
echo "<html><head><meta http-equiv='Refresh' content='0; URL=../../../index.php'></head></html>";
?>