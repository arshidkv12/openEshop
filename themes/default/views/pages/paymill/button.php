<?php defined('SYSPATH') or die('No direct script access.');?>
<form action="<?php echo Route::url('default',array('controller'=>'paymill','action'=>'pay','id'=>$order->id_order))?>" method="post">
    <script
        src="https://button.paymill.com/v1/"
        id="button"
        data-label="<?php echo __('Pay with Card')?>"
        data-title="<?php echo HTML::chars($order->product->title)?>"
        data-description="<?php echo Text::limit_chars(Text::removebbcode($order->product->description),30,NULL, TRUE)?>"
        data-amount="<?php echo Paymill::money_format($order->amount)?>"
        data-currency="<?php echo $order->currency?>"
        data-submit-button="<?php echo __('Pay')?> <?php echo i18n::format_currency($order->amount, $order->currency)?>"
        data-elv="false"
        data-lang="en-GB"
        data-height="36"
        data-width="146"
        data-public-key="<?php echo Core::config('payment.paymill_public')?>"
        >
    </script>
</form>