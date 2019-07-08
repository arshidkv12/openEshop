<?php defined('SYSPATH') or die('No direct script access.');?>

<form action="<?php echo $form_action?>" method="post">
<input type="hidden" name="sid" value="<?php echo Core::config('payment.twocheckout_sid')?>" />
<input type="hidden" name="mode" value="2CO" />
<input type="hidden" name="li_0_type" value="product" />
<input type="hidden" name="li_0_tangible" value="N" />
<input type="hidden" name="li_0_name" value="<?php echo $order->id_product?>" />
<input type="hidden" name="li_0_price" value="<?php echo str_replace(',', '.', round($order->amount,2))?>" />
<input type="hidden" name="li_0_quantity" value="1" />
<input type="hidden" name="currency_code" value="<?php echo $order->currency?>" />
<input type="hidden" name="email" value="<?php echo $order->user->email?>" />
<input type="hidden" name="x_receipt_link_url" value="<?php echo ( Core::config('payment.twocheckout_sandbox') == 1)?$order->id_order:Route::url('default', array('controller'=> 'twocheckout','action'=>'pay' , 'id' => $order->id_order))?>">
<input name="submit" class="btn btn-success" type="submit" value="<?php echo __('Pay With Card')?>" />
</form>