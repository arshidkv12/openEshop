<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo View::factory('pages/auth/social')?>
<form class="well form-horizontal auth" method="post" action="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>">         
    <?php echo Form::errors()?>
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('Email')?></label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="email" placeholder="<?php echo __('Email')?>">
        </div>
    </div>
     
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('Password')?></label>
        <div class="col-sm-8">
            <input class="form-control" type="password" name="password" placeholder="<?php echo __('Password')?>">
            <p class="help-block">
                <small><a data-toggle="modal" data-dismiss="modal" href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'forgot'))?>#forgot-modal">
                    <?php echo _e('Forgot password?')?>
                </a></small>
            </p>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" checked="checked"><?php echo _e('Remember me')?>
                </label>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <ul class="list-inline">
                <li>
                    <button type="submit" class="btn btn-primary">
                        <?php echo _e('Login')?>
                    </button>
                </li>
                <li>
                    <?php echo _e('Don’t Have an Account?')?>
                    <a data-toggle="modal" data-dismiss="modal" href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'register'))?>#register-modal">
                        <?php echo _e('Register')?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php echo Form::redirect()?>
    <?php echo Form::CSRF('login')?>
</form>         