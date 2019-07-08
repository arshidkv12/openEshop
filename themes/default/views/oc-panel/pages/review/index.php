<?php defined('SYSPATH') or die('No direct script access.');?>

<form class="form-inline" method="get" action="<?php echo URL::current();?>">
  	<div class="form-group pull-right">
  		<div class="">
	      	<input type="text" class="form-control search-query" name="email" placeholder="<?php echo __('email')?>" value="<?php echo core::get('email')?>">
		</div>
	</div>
</form>

<div class="page-header">
	<h1><?php echo __('Reviews')?></h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo __('User') ?></th>
                        <th><?php echo __('Product') ?></th>
                        <th><?php echo __('Order') ?></th>
                        <th><?php echo __('Rate') ?></th>
                        <th><?php echo __('Date') ?></th>
                        <th><?php echo __('Edit') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reviews as $review):?>
                        <?php if ($review->user->loaded() AND $review->product->loaded()):?>
                        <tr id="tr<?php echo $review->pk()?>">
                            <td><?php echo $review->pk()?></td>
                            <td><a href="<?php echo Route::url('oc-panel', array('controller'=> 'user', 'action'=>'update','id'=>$review->user->pk())) ?>">
                                <?php echo $review->user->name?></a> - <?php echo $review->user->email?>
                            </td>
                            <td><a href="<?php echo Route::url('oc-panel', array('controller'=> 'product', 'action'=>'update','id'=>$review->product->pk())) ?>">
                                <?php echo $review->product->title?></a></td>
                            <td><a href="<?php echo Route::url('oc-panel', array('controller'=> 'order', 'action'=>'update','id'=>$review->order->pk())) ?>">
                                <?php echo $review->order->amount.' '.$review->order->currency?></a></td>
                            <td><?php echo $review->rate?></td>
                            <td><?php echo $review->created?></td>
                            <td width="80" style="width:80px;">
                                <?php if ($controller->allowed_crud_action('update')):?>
                                <a title="<?php echo __('Edit')?>" class="btn btn-primary" href="<?php echo Route::url('oc-panel', array('controller'=> Request::current()->controller(), 'action'=>'update','id'=>$review->pk()))?>">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <?php endif?>
                            </td>
                        </tr>
                        <?php endif?>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center"><?php echo $pagination?></div>