<?php defined('SYSPATH') or die('No direct script access.');?>

<a class="btn btn-warning pull-right" href="<?php echo Route::url('oc-panel', array('controller'=> Request::current()->controller(), 'action'=>'pay')) ?>">
    <i class="glyphicon glyphicon-usd"></i>
    <?php echo __('Pay Affiliates')?>
</a>    
<a class="btn btn-primary pull-right" href="<?php echo Route::url('oc-panel', array('controller'=> 'settings', 'action'=>'affiliates')) ?>">
    <i class="glyphicon glyphicon-cog"></i>
    <?php echo __('Affiliates Config')?>
</a>

<form class="form-inline" method="get" action="<?php echo URL::current();?>">
    <div class="form-group pull-right">
        <div class="">
            <input type="text" class="form-control search-query" name="email" placeholder="<?php echo __('email')?>" value="<?php echo core::get('email')?>">
        </div>
    </div>
</form>

<div class="page-header">
    <h1><?php echo __('Affiliate Panel')?></h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                 <tr>
                    <th>#</th>
                    <th><?php echo __('Order')?></th>
                    <th><?php echo __('User')?></th>
                    <th><?php echo __('Date')?></th>
                    <th><?php echo __('Expected payment')?></th>
                    <th><?php echo __('Paid')?></th>
                    <th><?php echo __('Product')?></th>
                    <th><?php echo __('Commission')?></th>
                    <th><?php echo __('Status')?></th>
                    <th><?php echo __('Actions')?></th>
                </tr>
            </thead>
        
            <tbody>
                <?php foreach ($commissions as $c):?>
                    <tr>
                        <td>
                            <a class="btn btn-warning" title="<?php echo __('Affiliate stats')?>" href="<?php echo Route::url('oc-panel', array('controller'=> 'profile', 'action'=>'affiliate','id'=>$c->id_affiliate)) ?>">
                                <i class="glyphicon glyphicon-list"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo Route::url('oc-panel', array('controller'=> 'order', 'action'=>'update','id'=>$c->order->id_order)) ?>">
                                <?php echo $c->order->id_order?></a>
                        </td>
                        <td>
                            <a href="<?php echo Route::url('oc-panel', array('controller'=> 'user', 'action'=>'update','id'=>$c->user->pk())) ?>">
                                <?php echo $c->user->name?></a> - <?php echo $c->user->email?> 
                        </td>
                        <td><?php echo $c->created?></td>
                        <td><?php echo $c->date_to_pay?></td>
                        <td><?php echo $c->date_paid?></td>
                        <td><?php echo $c->product->title?></td>
                        <td><?php echo i18n::format_currency($c->amount, $c->currency)?> (<?php echo round($c->percentage,1)?>%)</td>
                        <td><?php echo Model_Affiliate::$statuses[$c->status]?></td>
        				<td width="80" style="width:80px;">
                            <?php if ($controller->allowed_crud_action('update')):?>
                            <a title="<?php echo __('Edit')?>" class="btn btn-primary" href="<?php echo Route::url('oc-panel', array('controller'=> Request::current()->controller(), 'action'=>'update','id'=>$c->pk()))?>">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <?php endif?>
                        </td>
                    </tr>
                <?php endforeach?> 
                </tbody>
        
            </table>
        </div>
    </div>
</div>
<div class="text-center"><?php echo $pagination?></div>


<p><?php echo __('Payout of commissions is after')?> <?php echo core::config('affiliate.payment_days')?> 
    <?php echo __('days and reached')?> <?php echo core::config('affiliate.payment_min')?> USD.
    <?php echo __('Affiliate cookie lasts')?> <?php echo core::config('affiliate.cookie')?> <?php echo __('days')?>.
<?php if (core::config('affiliate.tos')):?>
<a href="<?php echo Route::url('page',array('seotitle'=>core::config('affiliate.tos')))?>" target="_blank"><?php echo __('Affiliate terms')?></a>.
<?php endif?>
</p>