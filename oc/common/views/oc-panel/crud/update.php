<?php defined('SYSPATH') or die('No direct script access.');?>

<h1 class="page-header page-title" id="crud-<?php echo $name?>"><?php echo __('Update')?> <?php echo Text::ucfirst(__($name))?></h1>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php echo $form->render()?>
			</div>
		</div>
	</div>
</div>