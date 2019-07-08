<?php defined('SYSPATH') or die('No direct script access.');?>
<form class="well form-horizontal"  method="post" action="<?php echo Route::url('default',array('controller'=>'social',
                                                                                'action'=>'register',
                                                                                'id'    =>$provider)).'?uid='.$uid?>">         
          <?php echo Form::errors()?>
          <div class="form-group">
            <label class="control-label"><?php echo _e('Name')?></label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="name" value="<?php echo Core::post('name')?><?php echo Core::get('name')?>" placeholder="<?php echo __('Name')?>">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label"><?php echo _e('Email')?></label>
            <div class="col-md-4">
              <input class="form-control" type="text" name="email" value="<?php echo Core::post('email')?>" placeholder="<?php echo __('Email')?>">
            </div>
          </div>
     
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo _e('Register')?></button>
          </div>
          <?php echo Form::CSRF('register_social')?>
</form>      	
