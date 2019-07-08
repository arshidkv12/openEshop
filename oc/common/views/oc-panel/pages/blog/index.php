<?php defined('SYSPATH') or die('No direct script access.');?>
	
	<?php if ($controller->allowed_crud_action('create')):?>
	<a class="btn btn-primary pull-right ajax-load" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'create')) ?>" title="<?php echo __('New')?>">
	<i class="fa fa-plus-circle"></i>&nbsp;	<?php echo __('New')?>
	</a>				
	<?php endif?>

<h1 class="page-header page-title"><?php echo Text::ucfirst(__($name))?></h1>
	<?php if($name == 'role'):?><p><a href="https://docs.yclas.com/roles-work-classified-ads-script/" target="_blank"><?php echo __('Read more')?></a></p><?php endif;?>
<hr>

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
		<table class="table table-striped">
			<thead>
				<th><?php echo __('Title')?></th>
				<th class="hidden-sm hidden-xs"><?php echo __('Created')?></th>
				<th><?php echo __('Active')?></th>
				<th></th>
			</thead>
			<tbody>
				<?php foreach ($elements as $content):?>
					<?php if(isset($content->title)):?>
						<tr id="tr<?php echo $content->id_post?>">
							<td>
								<p><?php echo $content->title?></p>
								<p>
									<?php if ($content->status==1):?>
										<a title="<?php echo HTML::chars($content->title)?>" href="<?php echo Route::url('blog', array('seotitle'=>$content->seotitle))?>">
											<?php echo Route::url('blog', array('seotitle'=>$content->seotitle))?>
										</a>
									<?php else:?>
										<?php echo Route::url('blog', array('seotitle'=>$content->seotitle))?>
									<?php endif?>
								</p>
							</td>
							<td class="hidden-sm hidden-xs"><?php echo $content->created?></td>
							<td><?php echo ($content->status==1)?__('Yes'):__('No')?></td>
							<td width="5%" class="nowrap">
									
								<a class="btn btn-primary ajax-load" 
									href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'update','id'=>$content->pk()))?>" 
									rel="tooltip" title="<?php echo __('Edit')?>">
									<i class="glyphicon   glyphicon-edit"></i>
								</a>
								<a 
									href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'delete','id'=>$content->pk()))?>" 
									class="btn btn-danger index-delete" 
									title="<?php echo __('Are you sure you want to delete?')?>" 
									data-id="tr<?php echo $content->id_post?>" 
									data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
									data-btnCancelLabel="<?php echo __('No way!')?>">
									<i class="glyphicon glyphicon-trash"></i>
								</a>
									
							</td>
						</tr>
					<?php endif?>
				<?php endforeach?>
			</tbody>
		</table>
</div>

<div class="text-center"><?php echo $pagination?></div>