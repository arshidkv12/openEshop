<?php defined('SYSPATH') or die('No direct script access.');?>

	<?php if ($controller->allowed_crud_action('create')):?>
	<a class="btn btn-primary pull-right ajax-load" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'create')) ?>" title="<?php echo __('New')?>">
	<i class="fa fa-plus-circle"></i>&nbsp; <?php echo __('New')?>
	</a>				
	<?php endif?>

<h1 class="page-header page-title"><?php echo Text::ucfirst(__($name))?></h1>
<hr>
	<?php if($name == 'role'):?><p><a href="https://docs.yclas.com/roles-work-classified-ads-script/" target="_blank"><?php echo __('Read more')?></a></p><?php endif;?>


<?php if($name == "user") :?>
	<form class="form-horizontal" role="form" method="get" action="<?php echo URL::current();?>">
		<div class="form-group has-feedback">
			<label class="sr-only" for="search"><?php echo __('Search')?></label>
			<div class="col-md-4 col-md-offset-8">
				<input type="text" class="form-control search-query" name="search" placeholder="<?php echo __('Search users by name or email')?>" value="<?php echo core::get('search')?>">
				<span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
		</div>
	</form>
<?php endif?>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<?php foreach($fields as $field):?>
							<th><?php echo Text::ucfirst((method_exists($orm = ORM::Factory($name), 'formo') ? Arr::path($orm->formo(), $field.'.label', __($field)) : __($field)))?></th>
						<?php endforeach?>
						<?php if ($controller->allowed_crud_action('delete') OR $controller->allowed_crud_action('update')):?>
						<th><?php echo __('Actions') ?></th>
						<?php endif?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($elements as $element):?>
						<tr id="tr<?php echo $element->pk()?>">
							<?php foreach($fields as $field):?>
								<td><?php echo HTML::chars($element->$field)?></td>
							<?php endforeach?>
							<?php if ($controller->allowed_crud_action('delete') OR $controller->allowed_crud_action('update')):?>
							<td width="80" style="width:80px;">
								<?php if ($controller->allowed_crud_action('update')):?>
								<a title="<?php echo __('Edit')?>" class="btn btn-primary ajax-load" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'update','id'=>$element->pk()))?>">
									<i class="glyphicon   glyphicon-edit"></i>
								</a>
								<?php endif?>
								<?php if ($controller->allowed_crud_action('delete')):?>
								<a 
									href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'delete','id'=>$element->pk()))?>" 
									class="btn btn-danger index-delete" 
									title="<?php echo __('Are you sure you want to delete?')?>" 
									data-id="tr<?php echo $element->pk()?>" 
									data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
									data-btnCancelLabel="<?php echo __('No way!')?>">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
								<?php endif?>
							</td>
							<?php endif?>
						</tr>
					<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="text-center"><?php echo $pagination?></div>


<?php if ($controller->allowed_crud_action('export')):?>
<a class="btn btn-sm btn-success pull-right " href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'export')) ?>" title="<?php echo __('Export')?>">
    <i class="glyphicon glyphicon-download"></i>
    <?php echo __('Export all')?>
</a>                
<?php endif?>