<?php

require_once 'variables.php';


// проверка на количество ошибок при переходе с метода post
// и переадресация на главную
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    $errors = [];

    // проверка имени задачи
    $tname = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if (!$tname) {
        $errors['tname'] = 'Название не введено';
    };

    // проверка выбранного проекта
    $project = filter_input(INPUT_POST, 'project', FILTER_VALIDATE_INT, ['options' => ['default' => 0]]);

    // проверка даты
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if ($date) {
        
        if (is_date_valid($date)) {
            if (strtotime($date) < strtotime('now')) {
                $errors['date'] = 'Выбрана прошедшая или уже наступившая дата';
            }
        } else {
            $errors['date'] = 'Дата не корректна';
        }
    } else {
        $errors['date'] = 'Дата не заполнена';
    };


    // файл
    if (is_uploaded_file($_FILES['file']['tmp_name'])) { // была загрузка файла
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) { // Если загружен файл и нет ошибок, то сохраняем его в папку 
            $original_name = $_FILES['file']['name'];
            
            $target = __DIR__  . '/uploads/' . $original_name;

            // сохраняем файл в папке 
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                $errors['file'] = 'Не удалось сохранить файл.';
            }
        } else {
            $errors['file'] = 'Ошибка ' . $_FILES['file']['error'] . ' при загрузке файла. <a href="https://www.php.net/manual/ru/features.file-upload.errors.php" target="_blank">Код ошибки</a>';
        }
    };

    if ($errors == false && $date) {
        $user_id = $user['id'];
        $insert_in_task = 'INSERT INTO task (task_name, dt_deadline, status_ready, user_id, project_id, file_path) VALUES (?, ?, ?, ?, ?, ?)';
        
        // делаем подготовленное выражение
        $stmt = db_get_prepare_stmt($mysqli, $insert_in_task, [
            $tname, 
            $date,
             false, 
            $user_id,
            $project, 
            $original_name
        ]);
        
       // исполняем подготовленное выражение
       mysqli_stmt_execute($stmt);

       header("Location: /508085-doingsdone-12/");    
    } 

    
}; 
 // все варианты проектов
$query = "SELECT id, project_name FROM project";
$result = mysqli_query($mysqli, $query);
$all_projects_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);


$add_temp = include_template(
    'add_temp.php',
    [
        'all_projects_arr' => $all_projects_arr,
        'tname' => $tname,
        'date' => $date,
        'errors' => $errors
    ]
);


$layout = include_template(
    'layout.php',
    [
        'title' => 'Дела в порядке',
        'user' => $user['user_name'],
        'main' => $add_temp,
        'mysql' => $mysqli,
        'projects_arr' => $projects_arr,
        'project_id' => $project_id,
        'user_id' => $user['id'],
    ]
);


print($layout);
