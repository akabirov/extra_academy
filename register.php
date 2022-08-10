<?php
require_once 'variables.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if (!$email) {
        $errors['email'] = 'Нет email';
    };

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if (!$password) {
        $errors['password'] = 'Нет password';
    };

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if (!$name) {
        $errors['name'] = 'Нет name';
    };

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $today = date('d.m.Y');


    if (is_uploaded_file($_FILES['file']['tmp_name'])) { // была загрузка файла
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) { // Если загружен файл и нет ошибок, то сохраняем его в папку 
            $original_name = $_FILES['file']['name'];

            $avatar_path =  __DIR__  . '/uploads/' . $original_name;

            // сохраняем файл в папке 
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $avatar_path)) {
                $errors['file'] = 'Не удалось сохранить файл.';
            }
        } else {
            $errors['file'] = 'Ошибка ' . $_FILES['file']['error'] . ' при загрузке файла. <a href="https://www.php.net/manual/ru/features.file-upload.errors.php" target="_blank">Код ошибки</a>';
        }
    };

    if ($errors == false) {
        // SQL
        $insert_in_task = 'INSERT INTO user (dt_registered, password_hash, avatar_path, name, email) VALUES (?, ?, ?, ?, ?)';

        // делаем подготовленное выражение
        $stmt = db_get_prepare_stmt($mysqli, $insert_in_task, [
            $today,
            $passwordHash,
            $avatar_path, 
            $name,
            $email
        ]);

            // исполняем подготовленное выражение
        mysqli_stmt_execute($stmt);

        header("Location: /508085-doingsdone-12/");
    } 
 
};

$registr = include_template(
    'reg.php',
    [
        'all_projects_arr' => $all_projects_arr,
        'tname' => $tname,
        'date' => $date,
        'errors' => $errors
    ]
);
print($registr);
