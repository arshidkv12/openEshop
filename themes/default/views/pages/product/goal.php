<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if (isset($thanks_message)):?>
    <div class="page-header">
        <h1><?php echo $thanks_message->title?></h1>
    </div>
    <?php echo $thanks_message->description?>
<?php else:?>
    <div class="page-header">
        <h1><?php echo __('Thanks for your purchase!')?></h1>
    </div>
<?php endif?>

<?php if ( Kohana::$environment === Kohana::PRODUCTION AND core::config('general.analytics')!='' AND is_numeric($price_paid)): ?>
    <script type="text/javascript">
        ga('create', '<?php echo Core::config('general.analytics')?>');
        ga('require', 'ec');

        ga('ec:addProduct', {
          'id': '<?php echo $order->product->id_product?>',
          'name': '<?php echo HTML::chars($order->product->seotitle)?>',
          'category': '<?php echo HTML::chars($order->product->category->seoname)?>',
          'price': '<?php echo round($order->product->price,2)?>',
          'quantity': 1
        });

        // Transaction level information is provided via an actionFieldObject.
        ga('ec:setAction', 'purchase', {
          'id': '<?php echo $order->id_order?>',
          'affiliation': '<?php echo (Model_Affiliate::current()->loaded())?Model_Affiliate::current()->id_user:''?>',
          'revenue': '<?php echo round($product_price = (100*$order->amount)/(100+$order->VAT),2)?>',
          'tax': '<?php echo round($order->amount-$product_price,2)?>',
          'coupon': '<?php echo (is_numeric($order->id_coupon)?$order->coupon->name:'')?>'    // User added a coupon at checkout.
        });

        ga('send', 'pageview');     // Send transaction data with initial pageview.
    </script>
<?php endif?>

<hr>
<?php if (Auth::instance()->logged_in() AND $order->product->has_file()==TRUE):?>
        <a title="<?php echo __('Download')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'download','id'=>$order->id_order))?>" 
        class="btn btn-success">
        <i class="icon-download icon-white"></i> <?php echo __('Download')?> <?php echo $order->product->version?></a>
<?php elseif(!Auth::instance()->logged_in()):?>
    <a class="btn btn-info btn-large" data-toggle="modal" data-dismiss="modal" 
        href="<?php echo Route::url('oc-panel',array('controller'=>'auth','action'=>'Login'))?>#login-modal">
        <?php echo __('Login to proceed')?>
    </a>
<?php elseif(Auth::instance()->logged_in()):?>
        <a title="<?php echo __('Purchases')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'orders'))?>" 
        class="btn btn-success"> <?php echo __('Purchases')?> </a>
<?php endif?>
