<div class="checkbox">
    <label>
        <?
            if (!empty($form_values)) {
                $checked = !empty($form_values[$name]);
            } else {
                $checked = $default;
            }
        ?>
        <input type="checkbox" name="<?=_e($name)?>" <?=$checked ? 'checked':'' ?>> <?=_e($label) ?>
    </label>
</div>
<?
    unset($name,$label,$default); 
?>
