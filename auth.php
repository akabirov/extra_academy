<?php

require_once 'variables.php';


// проверка на наличие сессии 

if (isset($_SESSION['is_register'])) {
    header('Location: /extra_academy/');
    exit;
};


// проверка на количество ошибок при переходе с метода post
// и переадресация на главную
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    print(strtolower($email));


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // валиден ли емаил
        $errors['email'] = 'Email не валиден';
    };

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    if (!$password) {
       $errors['password'] = 'Нет password';

    } elseif ($password && $errors == false) {

        $hash = get_param_from_user($mysql, 'password_hash', $email);
        $user_id = get_param_from_user($mysql, 'id', $email);
        $name = get_param_from_user($mysql, 'name', $email);
    
    } else {
        print('false, неверный логин или пароль' . '<br>'); 
    }; // фиаско


    if (password_verify($password, $hash)) { // если пароль совпадает с хешем из базы, то
            

        session_start();
         $_SESSION['is_register'] = $user_id; //true;

         $_SESSION['user']['name'] = $name;
         $_SESSION['user']['id'] = $user_id;
 

        header("Location: /extra_academy/"); // успех /508085-doingsdone-12/
        exit; 
   
    };
};


// массив проектов
$projects_arr = base_extr($mysql, 'project', $_SESSION['user']['id']);


$add_temp = include_template(
    'auth_temp.php',
    [
        'mode_view' => $mode_view['is_register']
    ]
);

$layout = include_template(
    'layout.php',
    [
        'title' => 'Авторизация',
        'main' => $add_temp,
        'mysql' => $mysql,
        'projects_arr' => $projects_arr,
        'project_id' => $project_id,
    ]
);

print($layout);
