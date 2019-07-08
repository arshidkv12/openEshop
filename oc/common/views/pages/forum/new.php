<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?php echo _e("New Forum Topic")?></h1>
</div>

<div class="well">
	<?php if ($errors): ?>
    <div class="alert alert-warning">
	    <?php echo _e('Some errors were encountered, please check the details you entered.')?>
	    <ul class="errors">
		    <?php foreach ($errors as $message): ?>
		        <li><?php echo $message ?></li>
		    <?php endforeach ?>
	    </ul>
    </div>
    <?php endif ?>       
	<?php echo FORM::open(Route::url('forum-new'), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
	<fieldset>

        <div class="form-group control-group">
            <?php echo  FORM::label('id_forum', _e('Forum'), array('class'=>'col-md-2 control-label', 'for'=>'id_forum' ))?>
            <div class="col-md-6 controls">
                <select name="id_forum" id="id_forum" class="form-control input-xlarge" REQUIRED>
                    <option><?php echo __('Select a forum')?></option>
                    <?php foreach ($forums as $f):?>
                        <option value="<?php echo $f['id_forum']?>" <?php echo (core::request('id_forum')==$f['id_forum'])?'selected':''?>>
                            <?php echo $f['name']?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>

		<div class="form-group control-group">
			<?php echo  FORM::label('title', _e('Title'), array('class'=>'col-md-2 control-label', 'for'=>'title'))?>
			<div class="col-md-6 controls">
				<?php echo  FORM::input('title', core::post('title'), array('placeholder' => __('Title'), 'class' => 'form-control input-xlarge', 'id' => 'title', 'required'))?>
			</div>
		</div>
		<div class="form-group control-group">
			<?php echo  FORM::label('description', _e('Description'), array('class'=>'col-md-2 control-label', 'for'=>'description'))?>
			<div class="col-md-6 controls">
				<?php echo  FORM::textarea('description', core::post('description'), array('placeholder' => __('Description'), 'class' => 'form-control input-xxlarge', 'name'=>'description', 'id'=>'description', 'required'))?>	
			</div>
		</div>
		
		<?php if (core::config('advertisement.captcha') != FALSE OR core::config('general.captcha') != FALSE):?>
		<div class="form-group control-group">
			<div class="col-md-6 col-md-offset-2 controls">
				<?php if (Core::config('general.recaptcha_active')):?>
				    <?php echo Captcha::recaptcha_display()?>
				    <div id="recaptcha1"></div>
				<?php else:?>
				    <?php echo _e('Captcha')?>*:<br />
				    <?php echo captcha::image_tag('new-forum')?><br />
				    <?php echo  FORM::input('captcha', "", array('class' => 'form-control input-xlarge', 'id' => 'captcha', 'required'))?>
				<?php endif?>
			</div>
		</div>
		<?php endif?>
		<div class="clearfix"></div><br>
		<div class="form-group control-group">
			<div class="col-md-6 col-md-offset-2 controls">
				<?php echo  FORM::button('submit', _e('Publish new topic'), array('type'=>'submit', 'class'=>'btn btn-success', 'action'=>Route::url('forum-new')))?>
			</div>
		</div>
	</fieldset>
	<?php echo  FORM::close()?>

</div><!--end span10-->