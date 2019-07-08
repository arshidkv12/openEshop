<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
<?php if (core::config('general.cron') == FALSE):?>
    <a class="delete btn btn-success " 
        href="<?php echo Route::url('oc-panel', array('controller'=>'crontab','action'=>'status','id'=>1))?>"
        data-toggle="confirmation" 
        data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
        data-btnCancelLabel="<?php echo __('No way!')?>"
        title="<?php echo __('Activate')?>" >
        <i class="glyphicon   glyphicon-ok"></i> <?php echo __('Activate Cron')?>
    </a>
    <p><?php echo __('Or')?></p>
    <p><?php echo __('Set up your cron at your hosting / cPanel, every 5 minutes')?> (*/5 * * * *)</p>
    <input type="text" value="/usr/bin/php -f <?php echo DOCROOT?>oc/common/modules/cron/cron.php" />
    <p><?php echo __('Or')?></p>
    <input type="text" value="wget -O <?php echo Route::url('default', array('controller'=>'cron','action'=>'run','id'=>'now'))?>" />
<?php else:?>
    <a class="delete btn btn-danger " 
        href="<?php echo Route::url('oc-panel', array('controller'=>'crontab','action'=>'status','id'=>0))?>"
        data-toggle="confirmation" 
        data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
        data-btnCancelLabel="<?php echo __('No way!')?>"
        title="<?php echo __('Disable')?>" >
        <i class="glyphicon   glyphicon-remove"></i> <?php echo __('Disable Cron')?>
    </a>
<?php endif?>

</div>