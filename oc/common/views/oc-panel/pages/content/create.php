<?php defined('SYSPATH') or die('No direct script access.');?>

<h1 class="page-header page-title">
    <?php echo __('Create')?> <?php echo Controller_Panel_Content::translate_type($type)?>
</h1>

<hr>

<div class="panel panel-default">
    <div class="panel-body">
        <?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'content','action'=>'create')), array('enctype'=>'multipart/form-data'))?>
            <fieldset>
                <div class="form-group">
                    <?php echo FORM::label('title', __('Title'), array('class'=>'control-label', 'for'=>'title'))?>
                    <?php echo FORM::input('title', '', array('placeholder' => __('Title'), 'class' => 'form-control', 'id' => 'title', 'required'))?>
                </div>
                <div class="form-group">
                    <?php echo FORM::label('locale', __('Locale'), array('class'=>'control-label', 'for'=>'locale'))?>
                    <?php echo FORM::select('locale', $locale, core::config('i18n.locale'),array('placeholder' => __('locale'), 'class' => 'form-control', 'id' => 'locale', 'required'))?>
                </div>
                <div class="form-group">
                    <?php echo FORM::label('description', __('Description'), array('class'=>'control-label', 'for'=>'description'))?>
                    <?php echo FORM::textarea('description', '', array('class'=>'form-control','id' => 'description','data-editor'=>'html', 'placeholder'=>__('Description')))?>
                </div>
                
                <?php if(core::request('type') == 'email'):?>
                <div class="form-group">
                    <?php echo FORM::label('from_email', __('From email'), array('class'=>'control-label', 'for'=>'from_email'))?>
                    <?php echo FORM::input('from_email', '', array('placeholder' => __('from_email'), 'class' => 'form-control', 'id' => 'from_email'))?>
                </div>
                <?php endif?>
            
                <div class="form-group">
                    <?php echo FORM::label('seotitle', __('Seotitle'), array('class'=>'control-label', 'for'=>'seotitle'))?>
                    <?php echo FORM::input('seotitle', '', array('placeholder' => __('seotitle'), 'class' => 'form-control', 'id' => 'seotitle'))?>
                </div>
            
                <div class="form-group">
                    <?php echo FORM::hidden('type', $type, array('placeholder' => __('Type'), 'class' => 'form-control', 'id' => 'type'))?>
                </div>
                <div class="form-group">
                    <div class="checkbox check-success">
                        <input type="checkbox" name="status" id="status">
                        <label for="status"><?php echo __('Active')?></label>
                    </div>
                </div>
                <hr>
                <?php echo FORM::button('submit', __('Create'), array('type'=>'submit', 'class'=>'btn btn-success', 'action'=>Route::url('oc-panel',array('controller'=>'content','action'=>'create'))))?>
            </fieldset>
        <?php echo  FORM::close()?>
    </div>
</div>