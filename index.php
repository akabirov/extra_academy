<?php
session_start();


require_once 'variables.php';

$project_id = $_GET['project'];


// массив задач
$tasks_arr = base_extr($mysql, 'task', $_SESSION['user']['id']); 

// массив проектов
$projects_arr = base_extr($mysql, 'project', $_SESSION['user']['id']); 

// массив проектов с названиями задач
$projects_arr_name_by_tasks = join_tasks_and_projects($mysql, $_SESSION['user']['id']);  


// посчитали количество задач по проектам
$checker_get_param = array_count_values(array_column($tasks_arr, 'project_id'))[$project_id];        // array_count_values(

// либо он есть, либо приравнять к 0
$checker_get_param = $checker_get_param ?: 0;


$logic_for_header = (!$checker_get_param && $project_id) ? 0 : 1;

$checker_get_params = array_count_values(array_column($tasks_arr, 'project_id'))[$project_id];
$checker_get_params = $checker_get_params ?: 0;

 // шаблоны
$main = include_template(
    'main.php',
    [
        'tasks_arr' => $tasks_arr, 
        'show_complete_tasks' => $show_complete_tasks,
        'checker_get_param' => $checker_get_param,
        'project_id' => $project_id,
        'logic_for_header' => $logic_for_header,

    ]
);

$layout = include_template(
    'layout.php',
    [
        'title' => 'Дела в порядке',
        'main' => $main,
        'mode_view' => $mode_view['is_register'],
        'mysqli' => $mysql,
        'projects_arr'=> $projects_arr,
        'project_id' => $project_id,
        'projects_arr_name_by_tasks' => $projects_arr_name_by_tasks

    ]
);

print($layout);

