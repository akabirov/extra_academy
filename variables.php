<?php
require_once 'my_functions.php'; // 2 позиция
require_once 'helpers.php'; // 1 позиция

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$user = [
    'id' => 3,
    'user_name' => 'Вася',
];

//$user_id = $user['id'];


// подключение
$mysqli = mysqli_connect("localhost", "root", "mysql", "doinngsdone")
    or exit("Ошибка подключения: " . mysqli_connect_error());
mysqli_set_charset($mysql, 'utf8');

// надо именовать как $mysqli
// mysql - это название старого варианта модуля подключения к БД. Между нимим есть большие отличия
// переименовать подключение во всех файлах !!!

// массивы проектов
$projects_arr = base_extr($mysql, 'project', $user['id']);


// изввлекаем get-параметр номера проекта
$project_id = filter_input(INPUT_GET, 'project', FILTER_SANITIZE_NUMBER_INT);


?>
