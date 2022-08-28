<?php

require_once 'variables.php';


// проверка на количество ошибок при переходе с метода post
// и переадресация на главную
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $errors = [];

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // валиден ли емаил
        $errors['email'] = 'Email не валиден';
    };

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if (!$password) {
       $errors['password'] = 'Нет password';

    } elseif ($password && $errors == false) {

        $query = "SELECT password_hash FROM user WHERE email = '$email'"; // достаем слепок там где он равен введенному емаилу

        $result = mysqli_query($mysqli, $query);
    
        $old_hash = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['password_hash']; // слепок
    
        //print($result_fetch);
    
    
        if (password_verify($password, $old_hash)) { // если пароль совпадает с хешем из базы, то
            
            session_start();
            $_SESSION['is_register'] = true;
            

            header("Location: /508085-doingsdone-12/"); // успех auth.php
        } else {
            print('false, пароль не подходит к этому емаилу' . '<br>'); // фиаско
        };
 
   
    };
};


//////////////////////////////////
$add_temp = include_template(
    'auth.php',
    [
        'mode_view' => $mode_view['is_register']
    ]
);

$layout = include_template(
    'layout.php',
    [
        'title' => 'Авторизация',
        'user' => $user['user_name'],
        'main' => $add_temp,
        'mysql' => $mysqli,
        'projects_arr' => $projects_arr,
        'project_id' => $project_id,
        'user_id' => $user['id'],
    ]
);

print($layout);
