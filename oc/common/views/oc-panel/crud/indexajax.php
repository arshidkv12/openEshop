<?php defined('SYSPATH') or die('No direct script access.');?>
<?php if ($controller->allowed_crud_action('create')):?>
    <ul class="list-inline pull-right">
        <li>
            <a class="btn btn-primary ajax-load btn-icon-left" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'create')) ?>" title="<?php echo __('New')?>">
                <i class="fa fa-plus-circle"></i><?php echo __('New')?>
            </a>
        </li>
    </ul>
<?php endif?>

<h1 class="page-header page-title">
    <?php echo Text::ucfirst(__($name))?>
    <?php if($name == 'product'):?>
        <small><a href="https://docs.open-eshop.com/add-product/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php elseif($name == 'license'):?>
        <p><a href="https://docs.open-eshop.com/manage-licenses/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php elseif($name == 'user'):?>
        <small><a href="https://docs.yclas.com/manage-users/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php elseif($name == 'role'):?>
        <small><a href="https://docs.yclas.com/roles-work-classified-ads-script/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php elseif($name == 'order'):?>
        <small><a href="https://docs.yclas.com/how-to-manage-orders/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php elseif($name == 'crontab'):?>
        <small><a href="https://docs.yclas.com/how-to-set-crons/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php elseif($name == 'plan'):?>
        <small><a href="https://docs.yclas.com/membership-plans/" target="_blank"><i class="fa fa-question-circle"></i></a></small>
    <?php endif?>
</h1>

<hr>

<?php if($extra_info_view):?>
    <p><?php echo $extra_info_view?></p>
<?php endif?>

<div id="filter_buttons" data-url="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'ajax')).'?'.str_replace('rel=ajax','',$_SERVER['QUERY_STRING']) ?>">
    <?php if (count($filters)>0):?>
        <form class="form-inline form-hidden-elements" id="form-ajax-load" method="get" action="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'index')) ?>">
            <?php foreach($filters as $field_name=>$values):?>
                <?php if (is_array($values)):?>
                    <select name="filter__<?php echo $field_name?>" id="filter__<?php echo $field_name?>" class="form-control disable-chosen disable-select2" >
                        <option value=""><?php echo __('Select')?> <?php echo $field_name?></option>
                        <?php foreach ($values as $key=>$value):?>
                            <option value="<?php echo $key?>" <?php echo (core::request('filter__'.$field_name)==$key AND core::request('filter__'.$field_name)!==NULL)?'SELECTED':''?> >
                                <?php echo $field_name?> = <?php echo $value?>
                            </option>
                        <?php endforeach?>
                    </select>
                <?php elseif($values=='DATE'):?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><?php echo __('From')?> <?php echo $field_name?></div>
                            <input type="text" class="form-control datepicker_boot" id="filter__from__<?php echo $field_name?>" name="filter__from__<?php echo $field_name?>" value="<?php echo core::request('filter__from__'.$field_name)?>" data-date="<?php echo core::request('filter__from__'.$field_name)?>" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <span>-</span>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><?php echo __('To')?> <?php echo $field_name?></div>
                            <input type="text" class="form-control datepicker_boot" id="filter__to__<?php echo $field_name?>" name="filter__to__<?php echo $field_name?>" value="<?php echo core::request('filter__to__'.$field_name)?>" data-date="<?php echo core::request('filter__to__'.$field_name)?>" data-date-format="yyyy-mm-dd">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                <?php elseif($values=='RANGE'):?>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="filter__from__<?php echo $field_name?>" name="filter__from__<?php echo $field_name?>" placeholder="<?php echo __('From')?> <?php echo $field_name?>" value="<?php echo core::request('filter__from__'.$field_name)?>" >
                        </div>
                    </div>
                    <span>-</span>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="filter__to__<?php echo $field_name?>" name="filter__to__<?php echo $field_name?>" placeholder="<?php echo __('To')?> <?php echo $field_name?>" value="<?php echo core::request('filter__to__'.$field_name)?>" >
                        </div>
                    </div>
                       
                <?php elseif($values=='INPUT'):?>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="filter__<?php echo $field_name?>" name="filter__<?php echo $field_name?>" placeholder="<?php echo (isset($captions[$field_name])?$captions[$field_name]['model'].' '.$captions[$field_name]['caption']:$field_name)?>" value="<?php echo core::request('filter__'.$field_name)?>" >
                        </div>
                    </div>
                <?php endif?>
            <?php endforeach?>
            <button type="submit" class="btn btn-primary btn-icon-left"><?php echo __('Filter')?></button>
        </form>
    <?php endif?>
</div>

<div class="clearfix"></div>

<div class="panel panel-default">
    <div class="table-responsive">
        <table id="grid-data-api" class="table table-striped table-responsive">
            <thead>
                <tr>
                    <?php foreach($fields as $field):?>
                        <th data-column-id="<?php echo $field?>" <?php echo ($elements->primary_key() == $field)?'data-identifier="true"':''?> >
                            <?php if(isset($captions[$field]) AND !exec::is_callable($captions[$field])):?>
                                <?php echo Text::ucfirst($captions[$field]['model'].' '.$captions[$field]['caption'])?>
                            <?php else:?>
                                <?php echo Text::ucfirst($field)?>
                            <?php endif?>
                        </th>
                    <?php endforeach?>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">
                        <?php echo __('Actions')?>
                    </th>
                </tr>
            </thead>
        </table>
    </div>

    <?php if ($controller->allowed_crud_action('export')):?>
        <div class="panel-footer">
            <p class="text-right">
                <a class="btn btn-success" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'export')) ?>" title="<?php echo __('Export')?>">
                    <i class="glyphicon glyphicon-download"></i>
                    <?php echo __('Export all')?>
                </a>
            </p>
        </div>            
    <?php endif?>
</div>