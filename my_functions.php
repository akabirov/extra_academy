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
 * @param $mysql подключкние к бд
 * @param int $user_id идетификатор пользователя
 * @return integer 
 */
function count_tasks2($mysql, $project_id, $user_id){    
     $query_count = "SELECT COUNT(id) FROM task WHERE project_id = $project_id and user_id = $user_id";
     $result = mysqli_query($mysql,  $query_count)
          or exit('Ошибка подключения к бд в функции');
     $row = mysqli_fetch_row($result);

     return $row[0];
};
     

/**
 * Получаем интервал времени от текущего момента до заданной даты (в час).
 *      Результат возможен с дробной частью.
 *      Отрицательное значение говорит о том, что указанная дата уже в прошлом.
 * @param string $sample_date дата в формате 'dd.mm.yyyy'
 * @return float положительное, нулевое или отрицательное число
 */
function count_hours($sample_date) {
     if ($sample_date) {
          $ts_of_date  = strtotime($sample_date);
          $ts_current = time();
          $diff_seconds = $ts_of_date - $ts_current;
          $diff_in_hours = $diff_seconds / 3600;
     }
     else {
          $diff_in_hours = 0;
     }
     return $diff_in_hours;
};

/**
* Извлекает все из заданной таблицы с фильтрацией по заданному user_id, 
* если таблица != project и есть get-параметр добавляет фильтрацию по проекту в get-параметре
* @param mysqli $mysql подключение к БД
* @param string $base таблица
* @param int $user_id id пользователя
* @return array 2-мерный массив
*/
function base_extr($mysql, $base, $user_id) {

     $query = "SELECT * FROM $base WHERE user_id = $user_id"; // получаем все из таблицы
    // не всё, а только данные одного пользователя

     if (isset($_GET["project"]) &&  $base != 'project') {       // если в $_GET есть ключ project и таблица не равна project ---проджект
          $project_id = filter_input(INPUT_GET, 'project', FILTER_SANITIZE_NUMBER_INT);
          $query .= " AND project_id =  $project_id";  // добавляем фильтрацию по текущему проекту
     };     
     
     $result = mysqli_query($mysql, $query);
     $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
     return $arr;
};




// функция для возврата заполненной формы
/** 
* Валидация значения в массиве $_POST
* @param string $name параметр массива $_POST
* @return int значение в массиве
*/
function get_post_val($name) {
     $inp_post = filter_input(INPUT_POST, $name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     //return $_POST[$name] ?? "";
     return $inp_post ?? "";
};
// эта функция фактически ничего не даёт. Обёртка. Одна строка замещается тоже одной строкой
// и название get_post_val - очень неоднозначно - сочетание get и post ! Здесь get в другом контексте, но в это надо вдумываться ..



/** связывает таблицы проектов и задач,
* достает список проектов с их идентификаторами и названиями по текущему user_id
* @param int user_id идентификатор пользователя
* @return array 2-мерный массив
*/
function merge_extr($user_id) {
     $mysql = mysqli_connect("localhost", "root", "mysql", "doinngsdone")
     or exit("Ошибка подключения: " . mysqli_connect_error());
     mysqli_set_charset($mysql, 'utf8');   

     $some_query = "SELECT DISTINCT project_name, project_id FROM (
          SELECT project_name, project_id FROM project RIGHT JOIN task ON task.project_id = project.id WHERE task.user_id = $user_id
          ) AS t;";
     $some_query_result = mysqli_query($mysql, $some_query);
     $some_query_arr = mysqli_fetch_all($some_query_result, MYSQLI_ASSOC);
return $some_query_arr;
};

// почему просто не:
//SELECT id,
//        project_name
//    FROM project
//    WHERE user_id = ' . $user_id . '
//    ORDER BY p_name

?>
