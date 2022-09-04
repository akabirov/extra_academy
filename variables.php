<?php
require_once 'helpers.php';
require_once 'my_functions.php';


// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// $user = [
//     'id' => 3,
//     'user_name' => 'Вася',
// ];



// подключение
$mysql = mysqli_connect("localhost", "root", "mysql", "doinngsdone") 
    or exit("Ошибка подключения: " . mysqli_connect_error());
mysqli_set_charset($mysql, 'utf8');


// массивы проектов
// $projects_arr = base_extr($mysqli, 'project', $_SESSION['user']['id']); 




?>