<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo Form::errors()?>

<ul class="list-inline pull-right">
    <li>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#install-theme">
            <i class="fa fa-download"></i> <?php echo __('Install theme')?>
        </button>
    </li>
</ul>

<h1 class="page-header page-title" id="page-themes">
    <?php echo __('Themes')?>
    <a target="_blank" href="https://docs.yclas.com/how-to-change-theme/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>

<hr>

<p><?php echo __('You can change the look and feel of your website here.')?></p>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><?php echo __('Current Theme')?></div>
            </div>
            <div class="panel-body">
                <div class="media">
                    <?php if ($scr = Theme::get_theme_screenshot(Theme::$theme))?>
                    <div class="media-left">
                        <img class="media-object" style="max-width:150px;" src="<?php echo $scr?>">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php echo $selected['Name']?>
                            <?php if (Theme::has_options()):?>
                                <a class="btn btn-xs btn-primary ajax-load" title="<?php echo __('Theme Options')?>" 
                                    href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'options'))?>">
                                    <i class="fa fa-wrench"></i> <?php echo __('Theme Options')?>
                                </a>
                            <?php endif?>
                        </h4>
                        <p><?php echo $selected['Description']?></p>
                        <?php if(Core::config('appearance.theme_mobile')!=''):?>
                            <p>
                                <?php echo __('Using mobile theme')?> <code><?php echo Core::config('appearance.theme_mobile')?></code>
                                <a class="btn btn-xs btn-warning" title="<?php echo __('Disable')?>" 
                                    href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'mobile','id'=>'disable'))?>">
                                    <i class="fa fa-minus"></i> <?php echo __('Disable')?>
                                </a>
                                <a class="btn btn-xs btn-primary" title="<?php echo __('Options')?>" 
                                    href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'options','id'=>Core::config('appearance.theme_mobile')))?>">
                                    <i class="fa fa-wrench"></i> <?php echo __('Options')?>
                                </a>
                            </p>
                        <?php endif?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h2 class="page-header page-title">
    <?php echo __('Available Themes')?>
</h2>

<hr>

<?php if (count($themes)>1):?>
    <div class="row">
        <?php $i=0;
        foreach ($themes as $theme=>$info):?>
            <?php if(Theme::$theme!==$theme):?>
            <?php if ($i%3==0):?><div class="clearfix"></div><?php endif?>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php if ($scr = Theme::get_theme_screenshot($theme)):?>
                            <img class="img-rounded img-responsive" src="<?php echo $scr?>">
                        <?php endif?>
                        
                        <div class="caption">
                            <h3><?php echo $info['Name']?></h3>
                            <p><?php echo $info['Description']?></p>
                            <p><?php echo $info['License']?> v<?php echo $info['Version']?></p>
                            <p>
                                <a class="btn btn-primary btn-block" href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'index','id'=>$theme))?>"><?php echo __('Activate')?></a>
                                <?php if (Core::config('appearance.allow_query_theme')=='1'):?>
                                <a class="btn btn-default btn-block" target="_blank" href="<?php echo Route::url('default')?>?theme=<?php echo $theme?>"><?php echo __('Preview')?></a> 
                                <?php endif?>   
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++;
            endif?>
        <?php endforeach?>
    </div>
<?php endif?>

<?php
$a_m_themes = count($mobile_themes);
if(Core::config('appearance.theme_mobile')!='')
    $a_m_themes--;

if ($a_m_themes>0):?>

    <h2 class="page-header page-title">
        <?php echo __('Available Mobile Themes')?>
    </h2>

    <hr>

    <div class="row">
        <?php $i=0; foreach ($mobile_themes as $theme=>$info):?>
            <?php if(Core::config('appearance.theme_mobile')!==$theme):?>
                <?php if ($i%3==0):?><div class="clearfix"></div><?php endif?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php if ($scr = Theme::get_theme_screenshot($theme)):?>
                                <img class="img-rounded img-responsive" src="<?php echo $scr?>">
                            <?php endif?>

                            <div class="caption">
                                <h3><?php echo $info['Name']?></h3>
                                <p><?php echo $info['Description']?></p>
                                <p><?php echo $info['License']?> v<?php echo $info['Version']?></p>
                                <p>
                                    <a class="btn btn-primary" href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'index','id'=>$theme))?>"><?php echo __('Activate')?></a>
                                    <a class="btn btn-default" target="_blank" href="<?php echo Route::url('default')?>?theme=<?php echo $theme?>"><?php echo __('Preview')?></a>    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;endif?>
        <?php endforeach?>
    </div>
<?php endif?>

<?php if (count($market)>0):?>
<h2><?php echo __('Themes Market')?></h2>
<p><?php echo __('Here you can find a selection of our premium themes.')?></p>
<p class="text-success"><?php echo __('All themes include support, updates and 1 site license.')?></p> <?php echo __('Also white labeled and free of ads')?>!

<?php echo View::factory('oc-panel/pages/market/listing',array('market'=>$market))?>    
<?php endif?>

<div class="modal fade" id="install-theme" tabindex="-1" role="dialog" aria-labelledby="installTheme" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                <h4 id="installTheme" class="modal-title"><?php echo __('Install theme')?></h4>
            </div>
            <div class="modal-body">
                <?php echo FORM::open(Route::url('oc-panel',array('controller'=>'theme','action'=>'download')))?>
                    <div class="form-group">
                        <?php echo FORM::label('license', __('Install theme from license.'), array('class'=>'control-label', 'for'=>'license' ))?> 
                        <input type="text" name="license" id="license" placeholder="<?php echo __('license')?>" class="form-control"/>
                    </div>
                    <button 
                        type="button" 
                        class="btn btn-primary submit" 
                        title="<?php echo __('Are you sure?')?>" 
                        data-text="<?php echo sprintf(__('License will be activated in %s domain.'), parse_url(URL::base(), PHP_URL_HOST))?>"
                        data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                        data-btnCancelLabel="<?php echo __('No way!')?>">
                        <?php echo __('Download')?>
                    </button>
                <?php echo FORM::close()?>
                
                <hr>

                <?php echo FORM::open(Route::url('oc-panel',array('controller'=>'theme','action'=>'install_theme')), array('enctype'=>'multipart/form-data'))?>
                    <div class="form-group">
                        <?php echo FORM::label('theme_file', __('To install new theme choose zip file.'), array('class'=>'control-label', 'for'=>'theme_file' ))?> 
                        <input type="file" name="theme_file" id="theme_file" class="form-control" />
                    </div>
                    <?php echo FORM::button('submit', __('Upload'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'theme','action'=>'install_theme'))))?>
                <?php echo FORM::close()?>
            </div>
        </div>
    </div>
</div>
