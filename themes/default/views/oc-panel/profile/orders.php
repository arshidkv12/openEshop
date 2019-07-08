<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
	<h1><?php echo __('Purchases')?></h1>
    
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                     <tr>
                        <th>#</th>
                        <th><?php echo __('Product')?></th>
                        <th><?php echo __('Purchased')?></th>
                        <th><?php echo __('Support until')?></th>
                        <th><?php echo __('Price')?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order):?>
                        <tr>
                            <td><?php echo $order->id_order;?></td>
                            <td><?php echo $order->product->title?> <?php echo $order->product->version?></td>
                            <td><?php echo Date::format($order->pay_date);?></td>
                            <td><?php echo ($order->support_date!=NULL)?Date::format($order->support_date):__('Without support');?></td>
                            <td><?php echo i18n::money_format($order->amount).' '.$order->currency;?></td>
                            <td>
                                <?php if (core::config('product.reviews')==1 AND Theme::get('premium')==1):?>
                                    <a title="<?php echo __('Product Review')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'review','id'=>$order->id_order))?>" 
                                        class="btn btn-mini btn-warning">
                                        <i class="glyphicon glyphicon-star-empty"></i></a>
                                <?php endif?>
                                <?php if($order->product->has_file()==TRUE):?>
                                <a title="<?php echo __('Download')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'download','id'=>$order->id_order))?>" 
                                class="btn btn-mini btn-success">
                                <i class="glyphicon glyphicon-download"></i> <?php echo __('Download')?> <?php echo $order->product->version?></a>
                                <?php endif?>
                                <?php if ($order->licenses->count_all()>0):?>
                                    <button type="button" class="btn btn-mini btn-info btn-licenses" data-licenses="id_<?php echo $order->id_order;?>">
                                        <span class="glyphicon glyphicon-list-alt "></span>
                                    </button>
                                <?php endif?>
                                <a title="<?php echo __('print order')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'order','id'=>$order->id_order))?>" 
                                class="btn btn-mini btn-success">
                                <i class="glyphicon glyphicon-print"></i> <?php echo $order->product->version?></a>
                            </td>
                            <?php if ($order->licenses->count_all()>0):?>
                                <tr id="id_<?php echo $order->id_order;?>" style="display:none;">
                                    <td colspan="6">
                                        <table class="table table-striped custab">
                                            <th><?php echo __('License')?></th>
                                            <th><?php echo __('Created')?></th>
                                            <th><?php echo __('Domain')?></th>
                                        <?php foreach ($licenses as $license):?>
                                            <?php if($license->id_order == $order->id_order):?>
                                            <tr>
                                                <td><?php echo $license->license?></td>
                                                <td><?php echo $license->created?></td>
                                                <td><?php echo ($license->status==Model_License::STATUS_NOACTIVE)?__('Inactive'):$license->domain?></td>
                                            <tr>
                                            <?php endif?>
                                        <?php endforeach?>    
                                        </table>
                                    </td>
                                </tr>
                            <?php endif?>
                        </tr>
                    <?php endforeach?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
