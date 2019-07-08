<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->text_title!=''):?>
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $widget->text_title?></h3>
	</div>
<?php endif?>

<div class="panel-body">
	<?php echo $widget->text_body?>
</div>