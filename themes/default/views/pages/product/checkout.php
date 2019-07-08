<?php defined('SYSPATH') or die('No direct script access.');?>

<!-- ******Panel Section****** --> 
<section class="user-panel user-panel-listing section has-bg-color">
    <div class="container">
        <h2 class="title text-center"><i class="fa fa-shopping-cart"></i> <?php echo __('Checkout')?></h2>
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="panel">
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong><?php echo core::config('general.site_name')?></strong>
                                <br>
                                <?php echo Kohana::$base_url?>
                                <?php if (core::config('general.company_name')!=''):?>
                                <br>
                                <em><?php echo core::config('general.company_name')?></em>
                                <?php endif?>
                                <?php if (core::config('general.vat_number')!=''):?>
                                <br>
                                <em><?php echo core::config('general.vat_number')?></em>
                                <?php endif?>
                                <br>
                                <em><?php echo __('Date')?>: <?php echo  Date::format($order->created, core::config('general.date_format'))?></em>
                                <br>
                                <em><?php echo __('Order')?> #: <?php echo $order->id_order?></em>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong><?php echo $user->name?></strong>
                                <br>
                                <?php echo $user->email?>
                                <?php if (strlen($order->VAT_number)>2):?>
                                <br>
                                <em><?php echo __('VAT')?> <?php echo $order->VAT_number?></em>
                                <?php endif?>
                                <br>
                                <em><?php echo euvat::country_name($order->country)?>, <?php echo $order->city?></em>
                                <br>
                                <em><?php echo $order->address?>, <?php echo $order->postal_code?></em>
                            </address>
                            <a class="btn btn-warning btn-xs pull-right"  href="<?php echo Route::url('oc-panel', array('controller'=> 'profile','action'=>'edit'))?>?order_id=<?php echo $order->id_order?>#billing" >
                                <i class="fa fa-credit-card"></i> <?php echo __('Update details')?>
                            </a>
                        </div>
                    </div><!--//row-->
                    <div class="row">
                        <h3 class="text-center"><?php echo __('Summary')?></h3>
                        <div class="col-xs-12">
                            <table class="table table-striped table-user-panel" id="checkout-table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th><?php echo __('Product')?></th>
                                        <th></th>
                                        <th class="text-center"><?php echo __('Price')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-1" style="text-align: center"><?php echo $order->id_product?></td>
                                        <td class="col-md-7">
                                            <?php echo $product->title?> 
                                        </td>
                                        <td class="col-md-2">
                                        </td>
                                        <td class="col-md-2 text-center">
                                            <?php echo i18n::format_currency($order->product->price, $order->currency)?>
                                        </td>
                                    </tr>
                                    <?php if ($order->coupon->loaded()):?>
                                        <?php $discount = ($order->coupon->discount_amount==0)?($order->product->price * $order->coupon->discount_percentage/100):$order->coupon->discount_amount;?>
                                        <tr>
                                            <td class="col-md-1" style="text-align: center">
                                                <?php echo $order->id_coupon?>
                                            </td>
                                            <td class="col-md-7">
                                                <?php echo __('Coupon')?> '<?php echo $order->coupon->name?>'
                                                <?php echo __('valid until')?> <?php echo Date::format($order->coupon->valid_date)?>.
                                            </td>
                                            <td class="col-md-2">
                                            </td>
                                            <td class="col-md-2 text-center text-danger">
                                                -<?php echo i18n::format_currency($discount, $order->currency)?>
                                            </td>
                                        </tr>  
                                    <?php endif?>     

                                    <?php if ($order->VAT > 0 OR (euvat::is_eu_country($order->country) 
                                                                AND core::config('general.eu_vat')==TRUE 
                                                                AND Date::mysql2unix($order->created) >= strtotime(euvat::$date_start))
                                            ):?>  
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><h4><strong><?php echo __('Sub Total')?>: </strong></h4></td>
                                            <td class="text-center">
                                                <h4>
                                                <?php if (!$order->coupon->loaded()):?>
                                                    <?php echo i18n::format_currency($order->product->price, $order->currency)?>
                                                <?php else:?>
                                                    <?php echo i18n::format_currency($order->product->price-$discount, $order->currency)?>
                                                <?php endif?>
                                                </h4>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">
                                                <h4><?php echo __('VAT')?> <?php echo round($order->VAT,1)?>%</h4>
                                                <small>
                                                    <?php echo euvat::country_name($order->country)?>
                                                    <?php echo (euvat::is_eu_country($order->country) AND strlen($order->VAT_number)>2) ?'VIES':''?>
                                                </small>
                                            </td>
                                            <td class="text-center"><h4>
                                                <?php if (!$order->coupon->loaded()):?>
                                                    <?php echo i18n::format_currency($order->VAT*$order->product->price/100, $order->currency)?>
                                                <?php else:?>
                                                    <?php echo i18n::format_currency($order->VAT*($order->product->price-$discount)/100, $order->currency)?>
                                                <?php endif?></h4>
                                            </td>
                                        </tr>            
                                    <?php endif?>       
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right"><h2><strong><?php echo __('Total')?>: </strong></h2></td>
                                        <td class="text-center text-danger"><h2><strong><?php echo i18n::format_currency($order->amount, $order->currency)?></strong></h2></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--//col-*-->
                        <div class="col-xs-4">
                            <form class="form-inline"  method="post" action="<?php echo Core::get('current_url')?>">         
                                <?php if ($order->coupon->loaded()):?>
                                    <?php echo Form::hidden('coupon_delete',$order->coupon->name)?>
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-minus"></span>
                                        <?php echo __('Delete coupon')?> '<?php echo $order->coupon->name?>'
                                    </button>
                                <?php else:?>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="coupon" value="<?php echo Core::request('coupon')?>" placeholder="<?php echo __('Coupon Name')?>">          
                                    </div>
                                        <button type="submit" class="btn btn-primary"><?php echo __('Add')?></button>
                                <?php endif?>       
                            </form>
                            <br>
                            <br>
                        </div><!--//col-*-->
                        <div class="col-xs-8 text-right">
                            
                            <a class="btn btn-success btn-lg paypal-pay" href="<?php echo Route::url('default', array('controller'=> 'paypal','action'=>'pay' , 'id' => $order->id_order))?>">
                                <?php echo __('Pay with Paypal')?> <i class="fa fa-long-arrow-right"></i>
                            </a>
                            <br><br>
                            
                            <div class="text-right">
                                <ul class="list-inline">
                                    <?php if(($pm = Paymill::button($order)) != ''):?>
                                        <li class="text-right"><?php echo $pm?></li>
                                    <?php endif?>
                                </ul>
                            </div>
                            <div class="text-right">
                                <ul class="list-inline">
                                    <?php if(($sk = StripeKO::button($order)) != ''):?>
                                        <li class="text-right"><?php echo $sk?></li>
                                    <?php endif?>
                                    <?php if(($bp = Bitpay::button($order)) != ''):?>
                                        <li class="text-right"><?php echo $bp?></li>
                                    <?php endif?>
                                    <?php if(($two = twocheckout::form($order)) != ''):?>
                                        <li class="text-right"><?php echo $two?></li>
                                    <?php endif?>
                                    <?php if(($paysbuy = paysbuy::form($order)) != ''):?>
                                        <li class="text-right"><?php echo $paysbuy?></li>
                                    <?php endif?>
                                    <?php if( ($alt = $order->alternative_pay_button()) != ''):?>
                                        <li class="text-right"><?php echo $alt?></li>
                                    <?php endif?>
                                    <?php if(($mp = MercadoPago::button($order)) != ''):?>
                                        <li class="text-right"><?php echo $mp?></li>
                                    <?php endif?>
                                </ul>
                            </div>
                            
                            <?php echo Controller_Authorize::form($order)?>

                        </div><!--//col-*-->
                    </div><!--//row-->
                </div><!--//panel-->
            </div><!--//col-*-->
        </div><!--//row-->
    </div><!--//container-->        
</section><!--//user-panel-->

<?php if (core::config('payment.fraudlabspro')!=''): ?>
<script>
    (function(){
        function s() {
            var e = document.createElement('script');
            e.type = 'text/javascript';
            e.async = true;
            e.src = ('https:' === document.location.protocol ? 'https://' : 'http://') + 'cdn.fraudlabspro.com/s.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(e, s);
        }             
        (window.attachEvent) ? window.attachEvent('onload', s) : window.addEventListener('load', s, false);
    })();
</script>
<?php endif?>