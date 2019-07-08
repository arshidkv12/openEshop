<?php defined('SYSPATH') or die('No direct script access.');?>

<h1 class="page-header page-title">
    <?php echo __('Media')?>
    <a target="_blank" href="https://docs.yclas.com/how-to-manage-uploaded-images/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>
<hr>

<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<th></th>
				<th><?php echo __('Image')?></th>
				<th><?php echo __('URL')?></th>
				<th></th>
			</thead>
			<tbody>
				<?php foreach ($images as $key => $image):?>
					<tr id="tr<?php echo $key?>">
						<td class="nowrap">
							<div style="max-width:200px;">
								<a class="thumbnail" href="<?php echo $image['url']?>" target="_blank"><img src="<?php echo $image['url']?>"></a>
							</div>
						</td>
						<td><?php echo $image['name']?></td>
						<td><?php echo $image['url']?></td>
						<td class="nowrap">
							<a 
								href="<?php echo Route::url('oc-panel', array('controller'=> Request::current()->controller(), 'action'=>'delete'))?>?name=<?php echo $image['name']?>" 
								class="btn btn-danger index-delete" 
								title="<?php echo __('Are you sure you want to delete?')?>" 
								data-id="tr<?php echo $key?>" 
								data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
								data-btnCancelLabel="<?php echo __('No way!')?>">
								<i class="glyphicon glyphicon-trash"></i>
							</a>
						</td>
					</tr>
				<?php endforeach?>
			</tbody>
		</table>
	</div>
</div>
