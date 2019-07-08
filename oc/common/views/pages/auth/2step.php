<?php defined('SYSPATH') or die('No direct script access.');?>	
	<div class="page-header">
		<h1><?php echo _e('2 Step Authentication')?></h1>
	</div>

    <form class="well form-horizontal auth"  method="post" action="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'2step'))?>">         
      <?php echo Form::errors()?>
      <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo _e('Verification Code')?></label>
        <div class="col-md-5 col-sm-5">
          <input class="form-control" type="text" name="code" placeholder="<?php echo __('Code')?>">
        </div>
      </div>
      <div class="page-header"></div>
      <div class="col-sm-offset-3">
        <button type="submit" class="btn btn-primary"><?php echo _e('Send')?></button>
      </div>
      <?php echo Form::redirect()?>
      <?php echo Form::CSRF('2step')?>
    </form>         
