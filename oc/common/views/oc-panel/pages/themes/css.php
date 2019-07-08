<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo Form::errors()?>

<h1 class="page-header page-title">
    <?php echo __('Custom CSS')?>
    <a target="_blank" href="https://docs.yclas.com/how-to-use-custom-css/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>

<hr>
    
<p>
    <?php echo __('Please insert here your custom CSS.')?>. <?php echo __('Current CSS file')?>  <?php echo HTML::anchor(Theme::get_custom_css())?>
</p>

<div class="row">
    <div class="col-md-12">
        <form action="<?php echo URL::base()?><?php echo Request::current()->uri()?>" method="post"> 
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo FORM::label('css_active', __('Custom CSS'), array('class'=>'control-label', 'for'=>'css_active'))?>
                        <div class="radio radio-primary">
                            <?php echo Form::radio('css_active', 1, (bool) $css_active, array('id' => 'css_active'.'1'))?>
                            <?php echo Form::label('css_active'.'1', __('Enabled'))?>
                            <?php echo Form::radio('css_active', 0, ! (bool) $css_active, array('id' => 'css_active'.'0'))?>
                            <?php echo Form::label('css_active'.'0', __('Disabled'))?>
                        </div>
                     </div>
                        
                    <div class="form-group">
                        <label class="control-label"><?php echo __('CSS')?></label>
                        <textarea rows="30" class="form-control" name="css"><?php echo $css_content?></textarea>
                    </div>
                        
                    <hr>
                    <?php echo FORM::button('submit', __('Save'), array('type'=>'submit', 'class'=>'btn btn-primary'))?>
                </div>
            </div>
        </form>
    </div>
</div>
