<?php

namespace Controllers;

class Tasks {

    const IMAGE_RESIZE_WIDTH = 320;
    const IMAGE_RESIZE_HEIGHT = 240;

    function view($template,$data=[]) {
        $path = __DIR__."/../../template/".$template.".php";
        if (file_exists($path)) {
            extract($data);
            include $path = __DIR__."/../../template/layout.php";;
        } else {
            die('template not found: '.$template);
        }
    }

    function redirect($relative) {
        header("Location: ".INDEX_URL."/".$relative);
        exit;
    }

    function get_flash() {
        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : false;
        unset($_SESSION['flash']);
        return $flash;
    }

    function set_flash($flash) {
        $_SESSION['flash'] = $flash;
    }

    function notFound() {
        $this->view('notFound',['title'=>'Ошибка 404']);
    }

    function login() {
        $errors = [];
        if (isset($_POST['login']) && isset($_POST['password'])) {
            if (empty($_POST['login'])) $errors['login'] = 'Логин - обязательное поле';
            if (empty($_POST['password'])) $errors['password'] = 'Пароль - обязательное поле';

            if (empty($errors)) {
                if (\Models\User::login($_POST['login'],$_POST['password'])) {
                    $this->redirect('');
                } else {
                    $errors['password'] = 'Неверная комбинация логина и пароля';
                }
            }
        }
        $this->view('login',['title'=>'Авторизация','errors'=>$errors,'form_values'=>$_POST]);
    }

    function logout() {
        \Models\User::logout();
        $this->redirect('');
    }

    function sort($sort,$order) {
        $this->index($sort,$order);
    }

    function index($sort='id',$order='desc') {
        $total = \Models\Task::getTotal();

        $page = !empty($_GET['p']) ? max(1,(int)$_GET['p']) : 1;
        $per_page = 3;

        $tasks = \Models\Task::get($per_page,($page-1)*$per_page,$sort,$order);
        $this->view('index',[
            'title'=>'Задачи',
            'tasks'=>$tasks,
            'total'=>$total,
            'total_pages' => ceil($total/$per_page),
            'page' => $page,
            'sort' => $sort,
            'order' => $order
        ]);
    }

    function create_task() {
        $errors = [];
        $preview_task = false;
        if (!empty($_POST)) {
            if (empty($_POST['username'])) $errors['username'] = 'Имя - обязательное поле';
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Нужен валидный e-mail';
            if (empty($_POST['text'])) $errors['text'] = 'Текст задачи обязателен';
            
            $image_uploaded = false;
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $image_uploaded = true;
                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    $errors['image'] = 'Не удалось загрузить файл. Ошибка: '.$_FILES['image']['error'];
                } else {
                    $image_info = getimagesize($_FILES['image']['tmp_name']);
                    $wrong_format_message = 'Неверный формат файла';
                    if ($image_info === false) {
                        $errors['image'] = $wrong_format_message;
                    } else {
                        if (($image_info[2] !== IMAGETYPE_GIF) && ($image_info[2] !== IMAGETYPE_JPEG) && ($image_info[2] !== IMAGETYPE_PNG)) {
                            $errors['image'] = $wrong_format_message;
                        }
                    }
                }
            }

            if (empty($errors)) {
                $task = new \Models\Task;
                $task->username = $_POST['username'];
                $task->email = $_POST['email'];
                $task->text = $_POST['text'];

                if (!empty($_POST['preview'])) {
                    $preview_task = $task;
                } else {
                    if ($image_uploaded) {
                        $task->image = uniqid().".".pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                        $upload_dir = realpath(__DIR__."/../../public_html/upload");

                        $file = \PhpThumb\Factory::create($_FILES['image']['tmp_name'],array('resizeUp'=>false));
                        $file->adaptiveResize(self::IMAGE_RESIZE_WIDTH,self::IMAGE_RESIZE_HEIGHT);
                        $file->save($upload_dir."/".$task->image);
                    }
                    $task->save();

                    $this->set_flash('Задача создана');
                    $this->redirect('');
                }
            }
        }
        $this->view('create_task',['title'=>'Новая задача','errors'=>$errors,'preview_task'=>$preview_task,'form_values'=>$_POST]);
    }

    function edit_task($id) {
        if (!\Models\User::auth()) $this->redirect('');
        $task = \Models\Task::getById($id);
        if (!$task) $this->redirect('');

        $errors = [];
        if (!empty($_POST)) {
            if (empty($_POST['text'])) $errors['text'] = 'Текст задачи обязателен';
            if (empty($errors)) {
                $task->text = $_POST['text'];
                $task->status = !empty($_POST['ready']) ? \Models\Task::STATUS_DONE : \Models\Task::STATUS_EMPTY;
                $task->save();

                $this->set_flash('Задача сохранена');
                $this->redirect('edit_task/'.$task->id);
            }
        }
        $this->view('edit_task',['title'=>'Редактировать задачу','errors'=>$errors,'task'=>$task,'form_values'=>$_POST]);
    }
}