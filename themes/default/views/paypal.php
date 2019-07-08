<?php defined('SYSPATH') or die('No direct script access.');?>

<!DOCTYPE HTML>
<html>
<body>
<div style="font-family: Arial; font-size: 20px; text-align: center; margin-top: 200px;">
    <?php echo __('Please wait while we transfer you to Paypal');?><br /><br />
    <form name="form1" id="form1" action="<?php echo $paypal_url;?>" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="cbt" value="<?php echo HTML::chars(sprintf(__('Return to %s'),$site_name))?>">
        <input type="hidden" name="business" value="<?php echo $paypal_account?>">
        <input type="hidden" name="item_name" value="<?php echo HTML::chars($item_name)?>">
        <input type="hidden" name="item_number" value="<?php echo $order_id?>">
        <input type="hidden" name="amount" value="<?php echo $amount?>">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="undefined_quantity" value="0">
        <input type="hidden" name="no_shipping" value="0">
        <input type="hidden" name="shipping" value="0">
        <input type="hidden" name="shipping2" value="0">
        <input type="hidden" name="handling" value="0.00">
        <input type="hidden" name="return" value="<?php echo $return_url?>">
        <input type="hidden" name="notify_url" value="<?php echo Route::url('default',array('controller'=>'paypal','action'=>'ipn'))?>">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="custom" value="">
        <input type="hidden" name="currency_code" value="<?php echo $paypal_currency?>">
        <input type="hidden" name="rm" value="2">
        <input type="hidden" name="bn" value="OpenClassifieds_SP">
        <input type="submit" value="<?php echo HTML::chars(__('Click here if you are not redirected'));?>">
    </form>
</div>
<script type="text/javascript">form1.submit();</script>
</body>
</html>
