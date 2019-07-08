<?php defined('SYSPATH') or die('No direct script access.');?>
<form class="well form-horizontal auth"  method="post" action="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'forgot'))?>">         
    <?php echo Form::errors()?>
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('Email')?></label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="email" placeholder="<?php echo __('Email')?>">
        </div>
    </div>

    <hr>

    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <ul class="list-inline">
                <li>
                    <button type="submit" class="btn btn-primary"><?php echo _e('Send')?></button>
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
    <?php echo Form::CSRF('forgot')?>
</form>         