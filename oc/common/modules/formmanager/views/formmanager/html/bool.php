<div class="checkbox check-success">
	<?php echo Form::checkbox($field['field_name'], '1', (bool)$field['value'], ['id' => $field['field_name'],])?>
	<label for="<?php echo $field['field_name']?>"></label>
</div>