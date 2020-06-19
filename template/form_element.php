<div class="form-group <?= !empty($errors[$name]) ? 'has-error': ''?>">
    <?
        if (isset($form_values[$name])) {
            $value = $form_values[$name];
        } else {
            $value = isset($default) ? $default : '';
        }
    ?>
    <label for="<?=$name?>"><?=_e($label)?></label>
    <input type="<?=!empty($type) ? $type : 'text' ?>" name="<?=$name?>" value="<?=_e($value) ?>" class="form-control" autofocus>
    <? if (!empty($errors[$name])): ?>
        <span class="help-block"><?=_e($errors[$name])?></span>
    <? endif ?>
</div>
<?
    unset($type,$name,$label); 
?>