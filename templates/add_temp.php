
<main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>
        
        <form class="form" action="add.php" method="post" autocomplete="off" enctype="multipart/form-data"> 
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input type="text" name='name' id='name' value='<?= $tname ?>' placeholder='Введите название' class='form__input<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors['tname']) echo ' form__input--error' ?> '>
               <?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
               <p class='form__message'><?= $errors['tname'] ?></p> 
               <?php endif; ?>
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select" name="project" id="project">

              <?php foreach ($all_projects_arr as $one_project): ?> 
              <option value= <?= $one_project["id"] ?> > <?= $one_project['project_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input type="text" name="date" id="date" value='<?= $date ?>' placeholder="Введите дату в формате ГГГГ-ММ-ДД" class='form__input form__input--date<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors['date']) echo ' form__input--error' ?> '>
              <?php if($_SERVER['REQUEST_METHOD'] == 'POST'): ?> 
               <p class='form__message'><?= $errors['date'] ?></p> 
              <?php endif; ?>
          </div>

          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="555">

              <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>
          <?php if($_SESSION['is_register'] == true):?>
          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
          <?php elseif($_SESSION['is_register'] == false): ?>
          <a class="welcome__button button" href="./register.php">Зарегистрироваться</a> 
        </form>
        <?php endif?>
      </main>