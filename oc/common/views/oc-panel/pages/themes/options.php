<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo Form::errors()?>

<h1 class="page-header page-title">
    <?php echo __('Theme Options')?> <?php echo (Request::current()->param('id')!==NULL)?Request::current()->param('id'):Theme::$theme?>
</h1>

<?php if(Core::config('appearance.theme_mobile')!=''):?>
    <p>
        <?php echo __('Using mobile theme')?> <code><?php echo Core::config('appearance.theme_mobile')?></code>
        <a class="btn btn-sm btn-primary" 
            title="<?php echo __('Options')?>" 
            href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'options','id'=>Core::config('appearance.theme_mobile')))?>">
            <i class="fa fa-wrench"></i> <?php echo __('Options')?>
        </a>
        <a class="btn btn-sm btn-warning" 
            title="<?php echo __('Disable')?>" 
            href="<?php echo Route::url('oc-panel',array('controller'=>'theme','action'=>'mobile','id'=>'disable'))?>">
            <i class="fa fa-minus"></i> <?php echo __('Disable')?>
        </a>
    </p>
<?php endif?>

<hr>

<p><?php echo __('Here are listed specific theme configuration values. Replace input fields with new desired values for the theme.')?></p>

<div class="row">
    <div class="col-md-12">
        <form action="<?php echo URL::base()?><?php echo Request::current()->uri()?>" method="post" enctype="multipart/form-data">
            <?php  //get field categories
                $field_categories = array();
                foreach ($options as $field => $attributes)
                {
                    if (isset($attributes['category']) AND ! in_array($attributes['category'], $field_categories))
                        $field_categories[] = $attributes['category'];
                }
            ?>
            <?php if (! empty($field_categories)):?>
                <div>
                    <ul class="nav nav-tabs nav-tabs-simple nav-tabs-left" id="tab-options">
                        <?php $i = 1; foreach ($field_categories as $key => $field_category):?>
                            <li class="<?php echo ($i == 1) ? 'active' : NULL?>">
                                <a data-toggle="tab" href="#tabOptions<?php echo $key?>" aria-expanded="<?php echo ($i == 1) ? 'true' : 'false'?>">
                                    <?php echo $field_category?>
                                </a>
                            </li>
                        <?php $i++; endforeach?>
                    </ul>
                    <div class="tab-content">
                        <?php $i = 1; foreach ($field_categories as $key => $field_category):?>
                            <div id="tabOptions<?php echo $key?>" class="tab-pane <?php echo ($i == 1) ? 'active in' : NULL?> fade">
                                <h4><?php echo __(':name Options', [':name' => $field_category])?></h4>
                                <hr>
                                
                                <?php foreach ($options as $field => $attributes):?>
                                    <?php if (isset($attributes['category']) AND $attributes['category'] == $field_category):?>
                                        <div class="form-group">
                                            <?php echo FORM::form_tag($field, $attributes, (isset($data[$field])) ? $data[$field] : NULL)?>
                                            <?php if ($attributes['display'] == 'select'):?>
                                                <div class="clearfix" style="height:28px;"></div>
                                            <?php endif?>
                                        </div>
                                    <?php endif?>
                                <?php endforeach?>

                                <hr>
                                <p>
                                    <?php echo FORM::button('submit', __('Update'), array('type'=>'submit', 'class'=>'btn btn-primary'))?>
                                </p>
                            </div>
                        <?php $i++; endforeach?>
                    </div>
                </div>
            <?php else:?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php foreach ($options as $field => $attributes):?>
                            <div class="form-group">
                                <?php echo FORM::form_tag($field, $attributes, (isset($data[$field]))?$data[$field]:NULL)?>
                            </div>
                        <?php endforeach?>
                        
                        <hr>
                        <?php echo FORM::button('submit', __('Update'), array('type'=>'submit', 'class'=>'btn btn-primary'))?>
                    </div>
                </div>
            <?php endif?>

        </form>
    </div>
</div>
