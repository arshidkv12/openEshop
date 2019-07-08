<?php defined('SYSPATH') or die('No direct script access.');?>
<form class="well form-horizontal auth"  method="post" action="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'request'))?>">         
          <?php echo Form::errors()?>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo _e('Name')?></label>
            <div class="col-md-5 col-sm-6">
              <input class="form-control" type="text" name="name" placeholder="<?php echo __('Name')?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo _e('Email')?></label>
            <div class="col-md-5 col-sm-6">
              <input class="form-control" type="text" name="email" placeholder="<?php echo __('Email')?>">
            </div>
          </div>
          <div class="page-header"></div>
          <div class="col-sm-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo _e('Send')?></button>
          </div>
          <?php echo Form::CSRF('request')?>
</form>      	