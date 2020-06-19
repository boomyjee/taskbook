<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Авторизация</h4>
    </div>
    <div class="panel-body">
        <form method="post">
            <? 
                $name = 'login'; $label = 'Логин';
                include 'form_element.php';
            ?>
            <? ;
                $name = 'password'; $label = 'Пароль'; $type = "password";
                include 'form_element.php';
            ?>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>