<?php defined('SYSPATH') or die('No direct script access.');?>

<h1 class="page-header page-title">
    <?php echo __('Social Authentication Settings')?>
    <a target="_blank" href="https://docs.yclas.com/how-to-login-using-social-auth-facebook-google-twitter/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>
<hr>

<?php if (Theme::get('premium')!=1):?>
    <div class="alert alert-info fade in">
        <p>
            <strong><?php echo __('Heads Up!')?></strong> 
            <?php echo __('Social authentication is only available with premium themes!').' '.__('Upgrade your Yclas site to activate this feature.')?>
        </p>
        <p>
            <a class="btn btn-info" href="<?php echo Route::url('oc-panel',array('controller'=>'theme'))?>">
                <?php echo __('Browse Themes')?>
            </a>
        </p>
    </div>
<?php endif?>
    
<div class="row">
    <div class="col-md-12">
        <?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'social', 'action'=>'index')), array('class'=>'ajax-load', 'enctype'=>'multipart/form-data'))?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <?php echo FORM::label('debug_mode', __('Debug Mode'), array('class'=>'control-label', 'for'=>'debug_mode'))?>
                        <div class="radio radio-primary">
                            <?php echo Form::radio('debug_mode', 1, (bool) $config['debug_mode'], array('id' => 'debug_mode'.'1'))?>
                            <?php echo Form::label('debug_mode'.'1', __('Enabled'))?>
                            <?php echo Form::radio('debug_mode', 0, ! (bool) $config['debug_mode'], array('id' => 'debug_mode'.'0'))?>
                            <?php echo Form::label('debug_mode'.'0', __('Disabled'))?>
                        </div>
                    </div>

                    <hr>
                    <?php echo FORM::button('submit', 'Update', array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'social', 'action'=>'index'))))?>
                </div>
            </div>

            <?php foreach ($config['providers'] as $api => $options):?>
                <div class="panel panel-default">
                    <div class="panel-body">       
                        <h4><?php echo $api?></h4>
                        <hr>
                    
                        <div class="form-group">
                            <div class="radio radio-primary">
                                <?php echo Form::radio($api, 1, (bool) $options['enabled'], array('id' => $api.'1'))?>
                                <?php echo Form::label($api.'1', __('Enabled'))?>
                                <?php echo Form::radio($api, 0, ! (bool) $options['enabled'], array('id' => $api.'0'))?>
                                <?php echo Form::label($api.'0', __('Disabled'))?>
                            </div>
                        </div>

                        <?php if(isset($options['keys']['id'])):?>
                            <div class="form-group">
                                <?php echo FORM::label($api.'_id_label', __('Id'), array('class'=>'control-label', 'for'=>$api))?>
                                <?php echo FORM::input($api.'_id', $options['keys']['id']);?>
                            </div>
                        <?php endif?>

                        <?php if(isset($options['keys']['key'])):?>
                            <div class="form-group">
                                <?php echo FORM::label($api.'_key_label', __('Key'), array('class'=>'control-label', 'for'=>$api))?>
                                <?php echo FORM::input($api.'_key', $options['keys']['key']);?>
                            </div>
                        <?php endif?>

                        <?php if(isset($options['keys']['secret'])):?>
                            <div class="form-group">
                                <?php echo FORM::label($api.'_secret_label', __('secret'), array('class'=>'control-label', 'for'=>$api))?>
                                <?php echo FORM::input($api.'_secret', $options['keys']['secret']);?>
                            </div>
                        <?php endif?>

                        <hr>
                        <?php echo FORM::button('submit', 'Update', array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'social', 'action'=>'index'))))?>
                    </div>
                </div>
            <?php endforeach?>
        <?php fORM::close()?>
    </div>
</div>