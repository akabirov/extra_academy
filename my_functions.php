<?php

/**
 * Возвращает количество задач относящихся к проекту
 * @param array $tasks массив с задачами
 * @param string $one_project название проекта 
 * @return integer 
 */
function count_tasks($tasks, $one_project)
{
     $count = 0;
     foreach ($tasks as $one) {
          if ($one['project_name'] == $one_project) {
               $count++;
          }
     };
     return $count;
};


/**
 * Возвращает количество задач относящихся к проекту
 * через sql запрос
 * @param string $project_id идентификатор проекта
 * @param $mysqli подключкние к БД
 * @param int $user_id идетификатор пользователя
 * @return integer 
 */
function count_tasks2($mysqli, $project_id, $user_id)
{
     $query_count = "SELECT COUNT(id) FROM task WHERE project_id = $project_id and user_id = $user_id";
     $result = mysqli_query($mysqli,  $query_count)
          or exit('Ошибка подключения к бд в функции');
     $row = mysqli_fetch_row($result);

     return $row[0];
};


/**
 * Получаем интервал времени от текущего момента до заданной даты (в час).
 * Результат возможен с дробной частью.
 * Отрицательное значение говорит о том, что указанная дата уже в прошлом.
 * @param string $sample_date дата в формате 'dd.mm.yyyy'
 * @return float положительное, нулевое или отрицательное число
 */
function count_hours($sample_date)
{
     if ($sample_date) {
          $ts_of_date  = strtotime($sample_date);
          $ts_current = time();
          $diff_seconds = $ts_of_date - $ts_current;
          $diff_in_hours = $diff_seconds / 3600;
     } else {
          $diff_in_hours = 0;
     }
     return $diff_in_hours;
};

/**
 * Извлекает все из заданной таблицы с фильтрацией по заданному user_id, 
 * если таблица != project и есть get-параметр добавляет фильтрацию по проекту в get-параметре
 * @param $mysqli подключение к БД
 * @param string $base таблица
 * @param int $user_id id пользователя
 * @return array 2-мерный массив
 */
function base_extr($mysqli, $base, $user_id)
{

     $query = "SELECT * FROM $base WHERE user_id = $user_id"; // получаем все из таблицы

     if (isset($_GET["project"]) &&  $base != 'project') {       // если в $_GET есть ключ project и таблица не равна project ---проджект
          $project_id = filter_input(INPUT_GET, 'project', FILTER_SANITIZE_NUMBER_INT);
          $query .= " AND project_id =  $project_id";  // добавляем фильтрацию по текущему проекту
     };

     $result = mysqli_query($mysqli, $query);
     $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
     return $arr;
};

/**
 * Извлекает значение емаил из таблицы пользователей 
 * если заданный емаил уже есть в базе
 * @param $mysqli подключение к БД
 * @param string $email емаил
 * @return string или null
 */
function is_email_exist($mysqli, $email)
{
     $query = "SELECT 
     case when email != 'null' then true else false end as 'founding_email_in_func'
     FROM user WHERE email = '$email'";

     $result = mysqli_query($mysqli,  $query)
          or exit('Ошибка подключения к бд в функции check_email');
     $row = mysqli_fetch_row($result);
     return $row[0];
};



/**
 * связывает таблицы проектов и задач,
 * достает список проектов с их идентификаторами и названиями по текущему user_id
 * @param $mysqli подключение к БД
 * @param int user_id идентификатор пользователя
 * @return array 2-мерный массив
 */
function join_tasks_and_projects($mysqli, $user_id)
{

     $some_query = "SELECT DISTINCT project_name, project_id FROM (
          SELECT project_name, project_id FROM project RIGHT JOIN task ON task.project_id = project.id WHERE task.user_id = $user_id
          ) AS t;";

     //$some_query = "SELECT DISTINCT project_name, id FROM project where user_id = $user_id"; Можно было бы здесь упростить и тогда так же добавлять записи в project, тогда бы раздули таблицу

     $some_query_result = mysqli_query($mysqli, $some_query);
     $some_query_arr = mysqli_fetch_all($some_query_result, MYSQLI_ASSOC);
     return $some_query_arr;
};




/** 
 * извлекает из таблицы user необходимый параметр с фильтрацией по email,
 * @param $mysqli подключение к БД
 * @param $param1 параметр, который нужно получить из таблицы 
 * @param $param2 параметр, который нужно получить из таблицы 
 * @param $param3 параметр, который нужно получить из таблицы 
 * @param $email email по которому фильтруем таблицу
 * @return array 2-мерный массив
 */
function get_param_from_user($mysqli, $param1, $param2, $param3, $email) 
{
     $query = "SELECT $param1, $param2, $param3 FROM user WHERE email = '$email'";
     $result = mysqli_query($mysqli, $query);
     $need_param = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]; // [$param]

     return $need_param;
};


