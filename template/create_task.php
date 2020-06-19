<? if (!empty($preview_task)): ?>
    <h3>Предпросмотр</h3>
    <table class='table table-striped preview-table task-table'>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Текст</th>
            <th>Картинка</th>
        </tr>
        <? $task = $preview_task ?>
        <tr>
            <td><?=_e($task->username)?></td>
            <td><?=_e($task->email)?></td>
            <td><?=_e($task->text)?></td>
            <td class='task-image-cell'></td>
        </tr>
    </table>
<? endif ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Новая задача</h4>
    </div>
    <div class="panel-body">
        <form class='create' method="post" enctype="multipart/form-data">
            <? 
                $name = 'username'; $label = 'Имя';
                include 'form_element.php';
            ?>
            <?
                $name = 'email'; $label = 'E-Mail';
                include 'form_element.php';
            ?>
            <?
                $name = 'text'; $label = 'Текст задачи';
                include 'form_element.php';
            ?>
            <?
                $name = 'image'; $label = 'Картинка'; $type = "file";
                include 'form_element.php';
            ?>

            <button type="submit" class="btn btn-primary">Создать задачу</button>
            <button class="btn btn-primary" name="preview" value="preview">Предпросмотр</button>
        </form>
    </div>
</div>