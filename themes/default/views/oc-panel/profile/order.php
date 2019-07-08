<!-- ******Panel Section****** --> 
<section class="user-panel user-panel-listing section has-bg-color">
    <div class="container">
        <h2 class="title text-center"><i class="fa fa-shopping-cart"></i> <?php echo __('Checkout')?></h2>
        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
                <div class="panel">
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong><?php echo Core::config('general.site_name')?></strong>
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
                                <em><?php echo __('Date')?>: <?php echo  Date::format($order->pay_date, core::config('general.date_format'))?></em>
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
                                            <?php $product_price = (100*$order->amount)/(100+$order->VAT);?>
                                            <?php echo i18n::format_currency( $product_price, $order->currency)?>
                                        </td>
                                    </tr>
                                    <?php if ($order->coupon->loaded()):?>
                                        <tr>
                                            <td class="col-md-1" style="text-align: center">
                                                <?php echo $order->id_coupon?>
                                            </td>
                                            <td class="col-md-7">
                                                <?php echo __('Coupon applied')?> '<?php echo $order->coupon->name?>'
                                            </td>
                                            <td class="col-md-2">
                                            </td>
                                            <td class="col-md-2 text-center text-danger">
                                            </td>
                                        </tr>  
                                    <?php endif?>   

                                    <?php if ($order->VAT > 0 OR (euvat::is_eu_country($order->country) 
                                                                AND core::config('general.eu_vat')==TRUE 
                                                                AND Date::mysql2unix($order->pay_date) >= strtotime(euvat::$date_start))
                                            ):?>   
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right"><h4><strong><?php echo __('Sub Total')?>: </strong></h4></td>
                                        <td class="text-center">
                                            <h4>
                                                <?php echo i18n::format_currency($product_price, $order->currency)?>
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
                                        <td class="text-center">
                                            <h4><?php echo i18n::format_currency($order->amount-$product_price, $order->currency)?></h4>
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
                       
                    </div><!--//row-->
                </div><!--//panel-->
            </div><!--//col-*-->
        </div><!--//row-->
        <?php if( ! core::get('print')):?>
        <div class="pull-right">
            <a target="_blank" class="btn btn-xs btn-success" title="<?php echo __('Print this')?>" href="<?php echo Route::url('oc-panel', array('controller'=>'profile', 'action'=>'order','id'=>$order->id_order)).URL::query(array('print'=>1))?>"><i class="glyphicon glyphicon-print"></i><?php echo __('Print this')?></a>
        </div>
    <?php endif;?>
    </div><!--//container-->        
</section><!--//user-panel-->

