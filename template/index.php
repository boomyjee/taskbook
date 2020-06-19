<h3>
    Задачи
    <a href="<?=url('create_task')?>" class="btn btn-primary pull-right">Создать задачу</a>
</h3>

<table class="table table-striped task-table">

    <? $sort_heading = function($field,$label) use ($sort,$order) {
        if ($sort==$field)
            $goto_order = $order=='asc' ? 'desc':'asc';
        else
            $goto_order = 'asc';
        ?>
        <th><a href="<?=url('sort/'.$field.'/'.$goto_order)?>">
            <?=_e($label)?>
            <? if ($sort==$field): ?>
                <span class="glyphicon glyphicon-triangle-<?=$order=='asc' ? 'top':'bottom'?>"></span>
            <? endif ?>
        </a></th>
        <?
    } ?>

    <tr>
        <? $sort_heading('id','ID') ?>
        <? $sort_heading('username','Имя') ?>
        <? $sort_heading('email','E-Mail') ?>
        <? $sort_heading('text','Текст') ?>
        <th>Картинка</th>
        <? $sort_heading('status','Статус') ?>
        <? if (!empty($user)): ?>
            <th><span class="glyphicon glyphicon-edit"></span></th>
        <? endif ?>
    </tr>

    <? foreach ($tasks as $task): ?>
        <tr>
            <td><?=_e($task->id)?></td>
            <td><?=_e($task->username)?></td>
            <td><?=_e($task->email)?></td>
            <td><?=_e($task->text)?></td>
            <td>
                <? if ($task->image): ?>
                    <img src="<?=url('upload/'._e($task->image))?>">
                <? endif ?>
            </td>
            <td>
                <? if ($task->status==\Models\Task::STATUS_DONE): ?>
                    Готова
                <? else: ?>
                    -
                <? endif ?>
            </td>
            <? if (!empty($user)): ?>
                <td>
                    <a href="<?=url('edit_task/'.$task->id)?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
            <? endif ?>
        </tr>
    <? endforeach ?>
</table>

<? if ($total_pages>1): ?>
    <ul class="pagination">
        <? for ($p=1;$p<=$total_pages;$p++): ?>
            <li class="<?=(($p==$page) ? 'active':'')?>">
                <a href="?p=<?=$p?>"><?=$p?></a>
            </li>
        <? endfor ?>
    </ul>
<? endif ?>