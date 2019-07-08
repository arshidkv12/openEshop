<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->currency_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $widget->currency_title?></h3>
    </div>
<?php endif?>
<div class="panel-body">
    <div class="btn-group curry-widget" data-currencies="<?php echo $widget->currencies;?>" data-default="<?php echo ($widget->default);?>">
        <div class="my-future-ddm"></div>
    </div>
</div>
