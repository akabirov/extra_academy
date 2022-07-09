<?php

require_once 'variables.php';
require_once 'my_functions.php'; // убрать. Уже есть в variables.php
require_once 'helpers.php'; // убрать. Уже есть в variables.php

$errors = [];

// все варианты проектов
$query= "SELECT id, project_name FROM project";
$result = mysqli_query($mysql, $query);
$all_projects_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);



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
    //$task_data['date'] = $date;
    if (is_date_valid($date)) {
        if (strtotime($date) < strtotime('now')) {
            $errors['date'] = 'Выбрана прошедшая или уже наступившая дата';
        }
    }
    else {
        $errors['date'] = 'Дата не корректна';
    }
}
else {
    $errors['date'] = 'Дата не заполнена';
};


// файл
if (is_uploaded_file($_FILES['file']['tmp_name'])) { // была загрузка файла
  if ($_FILES['file']['error'] === UPLOAD_ERR_OK) { // Если загружен файл и нет ошибок, то сохраняем его в папку UPLOAD_PATH
      $original_name = $_FILES['file']['name'];
      $url = 'uploads/' . $original_name;
      $target = __DIR__  . '/uploads/' . $original_name;

      // сохраняем файл в папке UPLOAD_PATH_IMG
      if (!move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
          $errors['file'] = 'Не удалось сохранить файл.';
      }
  }
  else {
      $errors['file'] = 'Ошибка ' . $_FILES['file']['error'] . ' при загрузке файла. <a href="https://www.php.net/manual/ru/features.file-upload.errors.php" target="_blank">Код ошибки</a>';
  }
};


// проверка на количество ошибок при переходе с метода post
// и переадресация на главную
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $errors == false && $date) {  // $errors_counter == 0
  $user_id = $user['id'];
  $insert_in_task = "INSERT INTO task (task_name, dt_deadline, status_ready, user_id, project_id, file_path) VALUES ('$tname', '$date', false, $user_id, '$project', '$url')";
  mysqli_query($mysql, $insert_in_task);

  header("Location: /508085-doingsdone-12"); 
} else {
    
    $add_temp = include_template(
        'add_temp.php', [
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
      'mysql' => $mysql,
      'projects_arr'=> $projects_arr,
      'project_id' => $project_id,
      'user_id' => $user['id'],
  ]
);

print($layout);
};
?>




