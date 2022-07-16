<?php


require_once 'my_functions.php';
require_once 'variables.php';
require_once 'helpers.php';
?>

<main class="content__main">
    <h2 class="content__main-heading"><?php if($logic_for_header == 0 ) echo 'Ошибка 404, такая страница отсутствует'; 
                                            else echo 'Список задач' ?></h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->

            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if ($show_complete_tasks == 1) echo " checked"; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">

        <?php foreach ($tasks_arr as $one_task) :
            if ($show_complete_tasks == 0 and $one_task["status_ready"] == 1) continue; ?>
            <tr class="tasks__item task<?php if ($one_task["status_ready"]) echo ' task--completed'; elseif (count_hours($one_task["dt_deadline"]) < 24) echo ' task--important'; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if ($one_task["status_ready"]) echo ' checked'; ?>>
                        <span class="checkbox__text"><?= htmlspecialchars($one_task["task_name"]); ?></span>
                    </label>
                </td>

                <td class="task__file">                     
                    <a class="download-link" href="<?php if ($one_task["file_path"]) echo 'uploads/'. $one_task['file_path']; ?>"> </a>
                </td>

                <td class="task__date"> <?= htmlspecialchars($one_task["dt_deadline"]); ?> </td> 
                <td class="task__controls"> 
                </td>
            </tr>
        <?php endforeach; ?>
        <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
    </table>
</main>


