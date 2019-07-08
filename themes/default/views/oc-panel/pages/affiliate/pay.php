<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
    <h1><?php echo __('Pay Affiliates')?></h1>
    <h2><?php echo __('Total to Pay')?> <?php echo i18n::format_currency($total_to_pay)?></h2>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                 <tr>
                    <th>#</th>
                    <th><?php echo __('User')?></th>
                    <th><?php echo __('Email')?></th>
                    <th>Paypal</th>
                    <th><?php echo __('Commission')?></th>
                    <th><?php echo __('Actions')?></th><th></th>
                </tr>
            </thead>
        
            <tbody>
                <?php foreach ($users as $u):?>
                    <tr>
                        <td>
                            <a class="btn btn-warning" title="<?php echo __('Affiliate stats')?>" href="<?php echo Route::url('oc-panel', array('controller'=> 'profile', 'action'=>'affiliate','id'=>$u->id_user)) ?>">
                                <i class="glyphicon glyphicon-list"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo Route::url('oc-panel', array('controller'=> 'user', 'action'=>'update','id'=>$u->id_user))?>">
                                <?php echo $u->name?></a>
                        </td>
                        <td><?php echo $u->email?></td>
                        <td><?php echo $u->paypal_email?></td>
                        <td><?php echo i18n::format_currency($users_to_pay[$u->id_user]['total'])?></td>
                        <?php if (Valid::email($u->paypal_email)):?>
                        <td>
                            <a target="_blank"href="https://www.paypal.com/cgi-bin/webscr?business=<?php echo $u->paypal_email?>&cmd=_xclick&currency_code=USD&amount=<?php echo round($users_to_pay[$u->id_user]['total'],2)?>&item_name=Commissions_<?php echo date('Y-m-d')?>">Paypal</a>
                        </td>
                        <td width="80" style="width:80px;">
                            <a
                                href="<?php echo Route::url('oc-panel', array('controller'=>'affiliate', 'action'=>'pay','id'=>$u->id_user))?>" 
                                class="btn btn-primary" 
                                title="<?php echo __('Mark as Paid')?>" 
                                data-toggle="confirmation" 
                                data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                                data-btnCancelLabel="<?php echo __('No way!')?>">
                                <i class="glyphicon glyphicon-usd"></i>
                            </a>
                        </td>
                        <?php endif?>
                    </tr>
                <?php endforeach?> 
                </tbody>
        
            </table>
        </div>
    </div>
</div>