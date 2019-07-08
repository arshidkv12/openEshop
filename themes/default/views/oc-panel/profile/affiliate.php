<?php defined('SYSPATH') or die('No direct script access.');?>


<div class="page-header">
	<h1><?php echo __('Affiliate Panel')?></h1>
    <div class="col-xs-3 pl-0">
        <label><?php echo __('Select Product')?></label>
        <select name="affiliate_percentage" id="affiliate_percentage" data-user="<?php echo $user->id_user?>">
            <option></option>
            <?php foreach ($products as $prod):?>
                <?php var_dump($prod->title)?>
                <option value="<?php echo $prod->id_product?>"
                        data-price="<?php echo __('Buy Now')?> <?php echo $prod->formated_price()?>" 
                        data-url="<?php echo Route::url('product', array('seotitle'=>$prod->seotitle,'category'=>$prod->category->seoname)) ?>?aff=<?php echo $user->id_user?>"
                        data-embed="<?php echo Core::config('general.base_url')?>embed.js?v=<?php echo core::VERSION?>">
                        <?php echo $prod->title?> <strong>%<?php echo round($prod->affiliate_percentage,1)?></strong></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="clearfix"></div><br>
    <p><?php echo __('Your affiliate ID is')?> <?php echo $user->id_user?>, 
        <?php echo __('example link')?> <span class="affi-example-link"><a target="_blank" href="<?php echo Route::url('default')?>?aff=<?php echo $user->id_user?>"><?php echo Route::url('default')?>?aff=<?php echo $user->id_user?></a></span>
    </p>

    <br>
        <p><?php echo __('Button with overlay')?>:</p>
            <textarea id="embed_button" class="col-md-4" onclick="this.select()"><script src="<?php echo Core::config('general.base_url')?>embed.js?v=<?php echo core::VERSION?>"></script>
                <a class="oe_button" href="<?php echo Core::config('general.base_url')?>"><?php echo __('Buy Now')?></a></textarea>

            <div class="clearfix"></div>
        
        </p>
    <br>
        <p><?php echo __('Button without overlay')?>:</p>
            <textarea id="no_embed_button" class="col-md-4" onclick="this.select()"><a class="oe_button" href="<?php echo Core::config('general.base_url')?>"><?php echo __('Buy Now')?></a></textarea>

            <div class="clearfix"></div>
        </p>
    <h2><?php echo __('Total earned')?> <?php echo i18n::format_currency($total_earnings)?></h2>
    <?php if($last_payment_date!==NULL):?>
    <h3><?php echo __('Since last payment')?> <?php echo i18n::format_currency($last_earnings)?> (<?php echo $last_payment_date?>)</h3>
    <?php endif?>
    <?php if ($due_to_pay>core::config('affiliate.payment_min')):?>
    <h3><?php echo __('Due to pay next cicle')?>: <?php echo i18n::format_currency($total_earnings)?></h3>
    <?php endif?>
</div>

<form id="edit-profile" class="form-inline" method="post" action="">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><?php echo __('From')?></div>
            <input type="text" class="form-control" id="from_date" name="from_date" value="<?php echo $from_date?>" data-date="<?php echo $from_date?>" data-date-format="yyyy-mm-dd">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <span>-</span>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon"><?php echo __('To')?></div>
            <input type="text" class="form-control" id="to_date" name="to_date" value="<?php echo $to_date?>" data-date="<?php echo $to_date?>" data-date-format="yyyy-mm-dd">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo __('Filter')?></button>
</form>

<br>

<h6 class="text-center"><?php echo __('Commissions')?></h6>
<div>
    <?php echo Chart::line($stats_daily, array('height'  => 200,
                                       'width'   => 400,
                                       'options' => array('responsive' => true, 'maintainAspectRatio' => false, 'multiTooltipTemplate' => '<%= datasetLabel %> - <%= value %>')))?>
</div>

<h2><?php echo __('Commissions')?></h2>
<div class="table-responsive">
    <table class="table table-striped">
    <thead>
         <tr>
            <th>#</th>
            <th><?php echo __('Date')?></th>
            <th><?php echo __('Clear commission')?></th>
            <th><?php echo __('Date Paid')?></th>
            <th><?php echo __('Product')?></th>
            <th><?php echo __('Commission')?></th>
            <th><?php echo __('Status')?></th>
            
        </tr>
    </thead>

    <tbody>
        <?php foreach ($commissions as $c):?>
            <tr>
                <td><?php echo $c->id_affiliate?></td>
                <td><?php echo $c->created?></td>
                <td><?php echo $c->date_to_pay?></td>
                <td><?php echo $c->date_paid?></td>
                <td><?php echo $c->product->title?></td>
                <td><?php echo i18n::format_currency($c->amount, $c->currency)?></td>
                <td><?php echo Model_Affiliate::$statuses[$c->status]?></td>
            </tr>
        <?php endforeach?> 
        </tbody>

    </table>
</div>

<?php echo $pagination?>

<?php if(count($payments)):?>
<h2><?php echo __('Payments')?></h2>
<div class="table-responsive">
    <table class="table table-striped">
    <thead>
         <tr>
            <th>#</th>
            <th><?php echo __('Method')?></th>
            <th><?php echo __('Date')?></th>
            <th><?php echo __('Amount')?></th>
            <th><?php echo __('Status')?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($payments as $p):?>
            <tr>
                <td><?php echo $p->id_order?></td>
                <td><?php echo $p->paymethod?></td>
                <td><?php echo $p->pay_date?></td>
                <td><?php echo i18n::format_currency($p->amount, $p->currency)?></td>
                <td><?php echo Model_Order::$statuses[$p->status]?></td>
            </tr>
        <?php endforeach?> 
        </tbody>

    </table>
</div>
<?php endif?>


<p><?php echo __('Payout of commissions is after')?> <?php echo core::config('affiliate.payment_days')?> 
    <?php echo __('days and reached')?> <?php echo core::config('affiliate.payment_min')?> USD.
    <?php echo __('Affiliate cookie lasts')?> <?php echo core::config('affiliate.cookie')?> <?php echo __('days')?>.
<?php if (core::config('affiliate.tos')):?>
<a href="<?php echo Route::url('page',array('seotitle'=>core::config('affiliate.tos')))?>" target="_blank"><?php echo __('Affiliate terms')?></a>.
<?php endif?>
</p>