<?php defined('SYSPATH') or die('No direct script access.');?>
<form action="<?php echo Route::url('default',array('controller'=>'stripe','action'=>'pay','id'=>$order->id_order))?>" method="post">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo Core::config('payment.stripe_public')?>"
    data-label="<?php echo __('Pay with Card')?>"
    data-name="<?php echo $order->product->title?>"
    data-description="<?php echo Text::limit_chars(Text::removebbcode($order->product->description), 30, NULL, TRUE)?>"
    <?php if (Auth::instance()->logged_in()):?>
        data-email="<?php echo Auth::instance()->get_user()->email?>"
    <?php endif?>
    data-amount="<?php echo StripeKO::money_format($order->amount)?>"
    data-currency="<?php echo $order->currency?>"
    data-locale="auto"
    <?php echo (Core::config('payment.stripe_address')==TRUE)?'data-address = "TRUE"':''?>
    <?php echo (Core::config('payment.stripe_alipay')==TRUE)?'data-alipay="true"':''?>
    >
  </script>
</form>