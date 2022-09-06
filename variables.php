<?php
require_once 'helpers.php';
require_once 'my_functions.php';


// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);




// подключение
$mysqli = mysqli_connect("localhost", "root", "mysql", "doinngsdone") 
    or exit("Ошибка подключения: " . mysqli_connect_error());
mysqli_set_charset($mysqli, 'utf8');



?>