<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo View::factory('pages/auth/social')?>
<form class="well form-horizontal register"  method="post" action="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'register'))?>">         
    <?php echo Form::errors()?>
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('Name')?></label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="name" value="<?php echo Request::current()->post('name')?>" placeholder="<?php echo __('Name')?>">
        </div>
    </div>
          
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('Email')?></label>
        <div class="col-sm-8">
            <input
                class="form-control" 
                type="text" 
                name="email" 
                value="<?php echo Request::current()->post('email')?>" 
                placeholder="<?php echo __('Email')?>" 
                data-domain='<?php echo (core::config('general.email_domains') != '') ? json_encode(explode(',', core::config('general.email_domains'))) : ''?>' 
                data-error="<?php echo __('Email must contain a valid email domain')?>"
            >
        </div>
    </div>
     
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('New password')?></label>
        <div class="col-sm-8">
            <input id="<?php echo isset($modal_form) ? 'register_password_modal' : 'register_password'?>" class="form-control" type="password" name="password1" placeholder="<?php echo __('Password')?>">
        </div>
    </div>
          
    <div class="form-group">
        <label class="col-sm-4 control-label"><?php echo _e('Repeat password')?></label>
        <div class="col-sm-8">
            <input class="form-control" type="password" name="password2" placeholder="<?php echo __('Password')?>">
            <p class="help-block">
                <?php echo _e('Type your password twice')?>
            </p>
        </div>
    </div>

    <?php if(core::config('advertisement.tos') != ''):?>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" required name="tos" id="tos"/> 
                        <a target="_blank" href="<?php echo Route::url('page', array('seotitle'=>core::config('advertisement.tos')))?>"> <?php echo _e('Terms of service')?></a>
                    </label>
                </div>
            </div>
        </div>
    <?php endif?>
    
    <div class="form-group">
        <?php if (core::config('advertisement.captcha') != FALSE OR core::config('general.captcha') != FALSE):?>
            <?php if (Core::config('general.recaptcha_active')):?>
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <?php echo Captcha::recaptcha_display()?> 
                    <div id="<?php echo isset($recaptcha_placeholder) ? $recaptcha_placeholder : 'recaptcha3'?>"></div>
                </div>
            <?php else:?>
                <label class="col-sm-4 control-label"><?php echo _e('Captcha')?>*:</label>
                <div class="col-sm-8">
                    <span id="helpBlock" class="help-block"><?php echo captcha::image_tag('register')?></span>
                    <?php echo  FORM::input('captcha', "", array('class' => 'form-control', 'id' => 'captcha', 'required', 'data-error' => __('Captcha is not correct')))?>
                </div>
            <?php endif?>
        <?php endif?>
    </div>
    
    <hr>
    
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <ul class="list-inline">
                <li>
                    <button type="submit" class="btn btn-primary"><?php echo _e('Register')?></button>
                </li>
                <li>
                    <?php echo _e('Already Have an Account?')?>
                    <a data-dismiss="modal" data-toggle="modal"  href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
                        <?php echo _e('Login')?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php echo Form::redirect()?>
    <?php echo Form::CSRF('register')?>
</form>         
