<?php


require_once 'variables.php';


// массив задач
$tasks_arr = base_extr($mysqli, 'task', $user['id']);
// массив проектов с названиями задач
$projects_arr_name_by_tasks = join_tasks_and_projects($user['id'], $mysqli);  

$checker_get_param = array_count_values(array_column($tasks_arr, 'project_id'))[$project_id];
$checker_get_param = $checker_get_param ?: 0;

$logic_for_header = (!$checker_get_param && $project_id) ? 0 : 1;



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
        'user' => $user,//['user_name'],
        'main' => $main,
        'mysqli' => $mysqli,
        'projects_arr'=> $projects_arr,
        'project_id' => $project_id,
        //'user_id' => $user['id'],
        'projects_arr_name_by_tasks' => $projects_arr_name_by_tasks
    ]
);

print($layout);





