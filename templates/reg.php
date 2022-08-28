 <!DOCTYPE html>
<html lang="ru"> 

        <main class="content__main">
          <h2 class="content__main-heading">Регистрация аккаунта</h2>

          <form class="form" action="register.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="form__row">
               <label class="form__label" for="email">E-mail <sup>*</sup></label>

               <input class="form__input<?php if($errors['email'] && $_SERVER['REQUEST_METHOD'] == 'POST'): echo' form__input--error';  endif ?> " type="text" name="email" id="email" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST'): echo $email; endif; ; ?>" placeholder="Введите e-mail">
               <?php if($errors['email'] && $_SERVER['REQUEST_METHOD'] == 'POST'):
               echo "<p class='form__message'>$errors[email]</p>";
               endif ?>
              
            </div>

            <div class="form__row">
               <label class="form__label" for="password">Пароль <sup>*</sup></label>

               <input class="form__input<?php if($errors['password'] && $_SERVER['REQUEST_METHOD'] == 'POST'): echo ' form__input--error'; endif ?> " type="password" name="password" id="password" value="<?php if(!$errors['password'] && $_SERVER['REQUEST_METHOD'] == 'POST'): echo $password; endif ?>" placeholder="Введите пароль">
               <?php if($errors['password'] && $_SERVER['REQUEST_METHOD'] == 'POST'): 
               echo "<p class='form__message'>Пароль не введен</p>";
               endif; ?>
            </div>

            <div class="form__row">
              <label class="form__label" for="name">Имя <sup>*</sup></label>

              <input class="form__input<?php if($errors['name'] && $_SERVER['REQUEST_METHOD'] == 'POST'): echo ' form__input--error'; endif ?> " type="text" name="name" id="name" value="<?php if(!$errors['name'] && $_SERVER['REQUEST_METHOD'] == 'POST'): echo $tname; endif ?>" placeholder="Введите имя">
              <?php if($errors['name'] && $_SERVER['REQUEST_METHOD'] == 'POST'): 
              echo "<p class='form__message'>Имя не введено</p>";
              endif; ?>
            </div>
            <div class="form__row">
             <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="">

              <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
              </label>
             </div>
            </div>
            <div class="form__row form__row--controls">
            <?php if($errors!= null && $_SERVER['REQUEST_METHOD'] == 'POST'):?>
              <p class='error-message'>Пожалуйста, исправьте ошибки</p>
             <?php endif; ?>
            
              <input class="button" type="submit" name="" value="Зарегистрироваться">
            </div>
          </form>
        </main>
      </div>
    
</html>
