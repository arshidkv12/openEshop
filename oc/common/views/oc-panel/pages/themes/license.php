<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo Form::errors()?>
<h1 class="page-header page-title"><?php echo __('Theme License')?> <?php echo (Request::current()->param('id')!==NULL)?Request::current()->param('id'):Theme::$theme?></h1>
<hr>
    <p><?php echo __('Please insert here the license for your theme.')?></p>

<div class="row">
    <div class="col-md-12">
        <form action="<?php echo URL::base()?><?php echo Request::current()->uri()?>" method="post"> 
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label"><?php echo __('License')?></label>
                        <input class="form-control" type="text" name="license" value="" placeholder="<?php echo __('License')?>">
                    </div>
                    <button 
                        type="button" 
                        class="btn btn-primary submit" 
                        title="<?php echo __('Are you sure?')?>" 
                        data-text="<?php echo sprintf(__('License will be activated in %s domain. Once activated, your license cannot be changed to another domain.'), parse_url(URL::base(), PHP_URL_HOST))?>"
                        data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                        data-btnCancelLabel="<?php echo __('No way!')?>">
                        <?php echo __('Check')?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
