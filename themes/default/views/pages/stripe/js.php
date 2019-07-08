<?php defined('SYSPATH') or die('No direct script access.');?>

$('#stripe_button').click(function(){
  var token = function(res){
    var $input = $('<input type=hidden name=stripeToken />').val(res.id);
    $('#stripe_form').append($input).submit();
  };

  StripeCheckout.open({
    key:         '<?php echo Core::config('payment.stripe_public')?>',
    amount:      <?php echo StripeKO::money_format($product->final_price())?>,
    currency:    '<?php echo $product->currency?>',
    name:        '<?php echo $product->title?>',
    description: '<?php echo Text::limit_chars(Text::removebbcode($product->description), 30, NULL, TRUE)?>',
    <?php if (Auth::instance()->logged_in()):?>
    email:       '<?php echo Auth::instance()->get_user()->email?>',
     <?php endif?>
    panelLabel:  'Checkout',
    token:       token
  });

  return false;
});