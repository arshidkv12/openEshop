<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="well">
	<?php echo Form::errors()?>
	<h1><?php echo __('Contact Us')?></h1>
	<?php echo  FORM::open(Route::url('contact'), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
	<fieldset>
		<?php if (!Auth::instance()->logged_in()):?>
        <div class="form-group">
        <?php echo  FORM::label('name', __('Name'), array('class'=>'col-sm-2 control-label', 'for'=>'name'))?>
            <div class="col-md-5">
                <?php echo  FORM::input('name', '', array('placeholder' => __('Name'), 'class' => 'form-control', 'id' => 'name', 'required'))?>
            </div>
        </div>
        <div class="form-group">
            <?php echo  FORM::label('email', __('Email'), array('class'=>'col-sm-2 control-label', 'for'=>'email'))?>
            <div class="col-md-5 ">
                <?php echo  FORM::input('email', '', array('placeholder' => __('Email'), 'class' => 'form-control', 'id' => 'email', 'type'=>'email','required'))?>
            </div>
        </div>
        <?php endif?>
		<div class="form-group">
			
			<?php echo  FORM::label('subject', __('Subject'), array('class'=>'col-md-2 control-label', 'for'=>'subject'))?>
			<div class="col-md-5 ">
				<?php echo  FORM::input('subject', "", array('placeholder' => __('Subject'), 'class' => 'form-control', 'id' => 'subject'))?>
			</div>
		</div>
		<div class="form-group">
			<?php echo  FORM::label('message', __('Message'), array('class'=>'col-md-2 control-label', 'for'=>'message'))?>
			<div class="col-md-9">
				<?php echo  FORM::textarea('message', "", array('class'=>'form-control', 'placeholder' => __('Message'), 'name'=>'message', 'id'=>'message', 'rows'=>7, 'required'))?>	
				</div>
		</div>
		
		<?php if (core::config('general.captcha') != FALSE):?>
			<div class="form-group">
				<div class="col-md-5 col-md-offset-2">
					<?php if (Core::config('general.recaptcha_active')):?>
						<?php echo Captcha::recaptcha_display()?>
	                    <div id="recaptcha1"></div>
	                <?php else:?>
						<?php echo __('Captcha')?>*:<br />
						<?php echo captcha::image_tag('contact')?><br />
						<?php echo  FORM::input('captcha', "", array('class' => 'form-control', 'id' => 'captcha', 'required'))?>
					<?php endif?>
				</div>
			</div>
		<?php endif?>
		<br>
		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<?php echo  FORM::button('submit', __('Contact Us'), array('type'=>'submit', 'class'=>'btn btn-success', 'action'=>Route::url('contact')))?>
			</div>
			<br class="clear">
		</div>
	</fieldset>
	<?php echo  FORM::close()?>

</div><!--end span10-->