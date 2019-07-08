<?php defined('SYSPATH') or die('No direct script access.');?>
<a class="btn btn-info pay-btn full-w" 
            href="<?php echo Route::url('default',array('controller'=>'bitpay','action'=>'pay','id'=>$order->id_order))?>">
            <?php echo __('Pay with Bitcoin')?></a>