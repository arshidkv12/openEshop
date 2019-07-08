<?php defined('SYSPATH') or die('No direct script access.');?>

<a class="btn btn-primary pull-right ajax-load" 
    href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'create')).'?type='.$type ?>" 
    rel="tooltip" title="<?php echo __('New')?>"><i class="fa fa-plus-circle"></i>&nbsp; <?php echo __('New')?>
</a>

<h1  class="page-header page-title"><?php echo Controller_Panel_Content::translate_type($type)?></h1>
<hr>

<?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'content','action'=>'list')), array('method'=>'GET','class'=>'form-horizontal', 'id'=>'locale_form','enctype'=>'multipart/form-data'))?>
    <div class="form-group">

        <div class="col-sm-4">
            <?php echo  FORM::label('locale', __('Locale'), array('class'=>'control-label', 'for'=>'locale'))?>
            <?php echo  FORM::select('locale_select', $locale_list, $locale )?> 
        </div>
        <div class="col-sm-4">
            <?php echo  FORM::hidden('type', $type )?> 
        </div>
    </div>
<?php echo  FORM::close()?>

<?php if (count($contents)>0):?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <ol class='plholder' id="ol_1" data-id="1">
                    <?php foreach($contents as $content):?>
                        <li data-id="<?php echo $content->id_content?>" id="<?php echo $content->id_content?>">
                            <div class="drag-item">
                                <span class="drag-icon"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span>
                                <div class="drag-name">
                                    <?php echo $content->title?>
                                    <?php if ($content->status==1) : ?>
                                        <span class="label label-info "><?php echo __('Active')?></span>
                                    <?php endif?>
                                </div>
                                <a class="drag-action ajax-load" title="<?php echo __('Edit')?>"
                                    href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'edit','id'=>$content->id_content))?>">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a 
                                    href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'delete','id'=>$content->id_content))?>"
                                    class="drag-action index-delete" 
                                    title="<?php echo __('Are you sure you want to delete?')?>" 
                                    data-id="<?php echo $content->id_content?>" 
                                    data-text="<?php echo __('All data contained will be deleted.')?>" 
                                    data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                                    data-btnCancelLabel="<?php echo __('No way!')?>">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </li>
                    <?php endforeach?>
                </ol><!--ol_1-->
                <span id='ajax_result' data-url='<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'saveorder'))?>?to_locale=<?php echo $locale?>&type=<?php echo $type?>'></span>
            </div>
        </div>
    </div>
</div>

<hr>
<?php else:?>
    <a class="btn btn-warning btn-lg pull-right" href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'copy'))?>?to_locale=<?php echo $locale?>&type=<?php echo $type?>"  >
        <?php echo sprintf(__('Create all new %s from original'),$type)?>
    </a>
<?php endif?>