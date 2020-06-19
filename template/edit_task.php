<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Редактировать задачу №<?=$task->id?></h4>
    </div>
    <div class="panel-body">
        <form class='create' method="post" enctype="multipart/form-data">
            <?
                $name = 'text'; $label = 'Текст задачи'; $default = $task->text;
                include 'form_element.php';
            ?>
            <?
                $name = 'ready'; $label = 'Готовность'; $default = $task->status==\Models\Task::STATUS_DONE;
                include 'form_element_checkbox.php';
            ?>
            <button type="submit" class="btn btn-primary">Редактировать задачу</button>
        </form>
    </div>
</div>