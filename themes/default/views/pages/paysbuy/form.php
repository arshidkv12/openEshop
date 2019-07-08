<?php defined('SYSPATH') or die('No direct script access.');?>
<form name="paysbuy" id="paysbuy" method="post" action="<?php echo $form_action?>?c=true&m=true&j=true&a=true&p=true&psb=true">
<input type="Hidden" Name="psb" value="psb"/>
<input Type="Hidden" Name="biz" value="<?php echo Core::config('payment.paysbuy')?>"/>
<input Type="Hidden" Name="inv" value="<?php echo $order->id_order?>"/>
<input Type="Hidden" Name="itm" value="<?php echo HTML::chars($order->product->title)?>"/>
<input Type="Hidden" Name="amt" value="<?php echo $order->amount?>"/>
<input Type="Hidden" Name="postURL" value="<?php echo Route::url('default',array('controller'=>'paysbuy','action'=>'pay','id'=>$order->id_order))?>"/>
<input type="image" src="https://www.paysbuy.com/imgs/S_click2buy.gif" border="0" name="submit" alt="Make it easier,PaySbuy - it's fast,free and secure!"/>
</form >