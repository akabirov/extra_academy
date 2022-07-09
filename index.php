<?php

require_once 'my_functions.php';  // убрать. Уже есть в variables.php
require_once 'variables.php';
require_once 'helpers.php';  // убрать. Уже есть в variables.php

// массив задач
$tasks_arr = base_extr($mysql, 'task', $user['id']);
// массив проектов с названиями задач
$projects_arr_name_by_tasks = merge_extr($user['id']);  
// очень громоздкое название. Проще!
// Убрать функцию merge_extr(). Совсем не нужна. Или кардинально переделать. Попроще!
// А попроще, значит не будет слова merge. Использование merge - подразумевают сливание однотипных данных, а не разных таблиц. Для разных таблиц используют JOIN


$checker_get_param = array_count_values(array_column($tasks_arr, 'project_id'))[$project_id];
$checker_get_param = $checker_get_param ?: 0;
// не нравится мне этот фрагмент. Пока интуитивно не нравится. Сложная логика восприятия ..

$logic_for_h2 = (!$checker_get_param && $project_id) ? 0 : 1;
// h2 - ассоциируется с зарезервированным тегом HTML


$main = include_template(
    'main.php',
    [
        'tasks_arr' => $tasks_arr, 
        'show_complete_tasks' => $show_complete_tasks,
        'checker_get_param' => $checker_get_param,
        'project_id' => $project_id,
        'logic_for_h2' => $logic_for_h2,
    ]
);

$layout = include_template(
    'layout.php',
    [
        'title' => 'Дела в порядке',
        'user' => $user['user_name'], // передаём $user. А в шаблоне извлечь user_name
        'main' => $main,
        'mysql' => $mysql,
        'projects_arr'=> $projects_arr,
        'project_id' => $project_id,
        'user_id' => $user['id'], // см.выше. связано со строкой 'user' => ..
        'projects_arr_name_by_tasks' => $projects_arr_name_by_tasks
    ]
);

print($layout);





