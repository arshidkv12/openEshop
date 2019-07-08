<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->text_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $widget->text_title?></h3>
    </div>
<?php endif?>

<div class="panel-body">
    <div id="tlkio" data-channel="<?php echo $widget->channel?>" data-custom-css="<?php echo Core::config('general.base_url').'themes/default/css/widget-chat.css'?>" style="width:100%;height:<?php echo $widget->height?>px;"></div>
    <script async src="//tlk.io/embed.js" type="text/javascript"></script>
</div>