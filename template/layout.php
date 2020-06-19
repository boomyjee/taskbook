<?php
    include __DIR__."/helpers.php";
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= _e($title) ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=url('assets/style.css')?>">
</head>
<body>

<div class="wrap">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?=url('')?>">Задачник</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <? $user = \Models\User::auth() ?>
                            <? if (!empty($user)): ?>
                                <li>
                                    <a href="<?=url('logout')?>"><?= $user->login ?> <span class="glyphicon glyphicon-log-out"></span></a>
                                </li>
                            <? else: ?>
                                <li>
                                    <a href="<?=url('login')?>">Логин</a>
                                </li>
                            <? endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 content">
                <? $flash = $this->get_flash() ?>
                <? if ($flash): ?>
                    <div class="alert alert-success">
                        <?=_e($flash)?>
                    </div>
                <? endif ?>
                <? include(__DIR__."/".$template.".php") ?>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?=url('assets/script.js')?>"></script>
</html>
