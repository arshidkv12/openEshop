<?php defined('SYSPATH') or die('No direct script access.');?>

<ul class="list-inline pull-right">
    <?php if($type == 'email'):?>
        <li>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#set-email-from">
                <?php echo __('Set Email From')?>
            </button>
        </li>
    <?php endif?>
    <li>
        <a class="btn btn-primary" 
            href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'create')).'?type='.$type ?>" 
            rel="tooltip" title="<?php echo __('New')?>">
            <i class="fa fa-plus-circle"></i>&nbsp; <?php echo __('New')?>
        </a>
    </li>
</ul>

<h1 class="page-header page-title">
    <?php echo Controller_Panel_Content::translate_type($type)?>
    <?php if($type == 'page'):?>
        <a href="https://docs.yclas.com/how_to_add_pages/" target="_blank"><i class="fa fa-question-circle"></i></a>
    <?php elseif($type == 'email'):?>
        <a href="https://docs.yclas.com/automatic-emails-sent-to-users/" target="_blank"><i class="fa fa-question-circle"></i></a>
    <?php endif?>
</h1>

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

<div class="panel panel-default">
    <?php if (count($contents)>0):?>
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo __('Title')?></th>
                    <th class="hidden-sm hidden-xs"><?php echo __('Seo Title')?></th>
                    <th class="hidden-xs"><?php echo __('Active')?></th>
                    <th><?php echo __('Actions')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contents as $content):?>
                    <?php if(isset($content->title)):?>
                        <tr id="tr<?php echo $content->id_content?>">
                            <td>
                                <p><?php echo $content->title?></p>
                                <?php if ($type=='page'): ?>
                                    <p>
                                        <?php if ($content->status==1):?>
                                            <a title="<?php echo HTML::chars($content->title)?>" href="<?php echo Route::url('page', array('seotitle'=>$content->seotitle))?>">
                                                <?php echo Route::url('page', array('seotitle'=>$content->seotitle))?>
                                            </a>
                                        <?php else:?>
                                            <?php echo Route::url('page', array('seotitle'=>$content->seotitle))?>
                                        <?php endif?>
                                    </p>
                                <?php endif?>
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $content->seotitle?></td>
                            <td class="hidden-xs"><?php echo ($content->status==1)?__('Yes'):__('No')?></td>
                            <td width="5%" class="nowrap">
                                
                                <a class="btn btn-primary ajax-load" 
                                    href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'edit','id'=>$content))?>" 
                                    rel="tooltip" title="<?php echo __('Edit')?>">
                                    <i class="glyphicon   glyphicon-edit"></i>
                                </a>
                                <?php if ( ! ($type == 'email' AND $locale == i18n::$locale_default)):?>
                                <a 
                                    href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'delete','id'=>$content->id_content))?>" 
                                    class="btn btn-danger index-delete" 
                                    title="<?php echo __('Are you sure you want to delete?')?>" 
                                    data-id="tr<?php echo $content->id_content?>" 
                                    data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                                    data-btnCancelLabel="<?php echo __('No way!')?>">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                                <?php endif?>
                                
                            </td>
                        </tr>
                    <?php endif?>
                <?php endforeach?>
            </tbody>
        </table>
    <?php else:?>
        <div class="panel-body">
            <a class="btn btn-warning btn-lg pull-right" href="<?php echo Route::url('oc-panel', array('controller'=>'content','action'=>'copy'))?>?to_locale=<?php echo $locale?>&type=<?php echo $type?>"  >
                <?php echo sprintf(__('Create all new %s from original'),$type)?>
            </a>
        </div>
    <?php endif?>
</div>

<?php if($type == 'email'):?>
    <div class="modal fade" id="set-email-from" tabindex="-1" role="dialog" aria-labelledby="setEmailFrom" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <?php echo FORM::open(Route::url('oc-panel',array('controller'=>'content','action'=>'set_from_email')), array('enctype'=>'multipart/form-data'))?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                        <h4 id="setEmailFrom" class="modal-title"><?php echo __('Set a New From Email')?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php echo FORM::label('from_email', __('From Email'), array('class'=>'control-label', 'for'=>'from_email'))?>
                            <?php echo FORM::input('from_email', Core::request('from_email'), array(
                                'placeholder' => 'youremail@mail.com', 
                                'class' => 'form-control', 
                                'id' => 'from_email',
                                'type' => 'email',
                                'required' => ''
                            ))?>
                            <span class="help-block">
                                <?php echo __("Set a new From Email on all the emails.")?>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel')?></button>
                        <?php echo FORM::button('submit', __('Send'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'content','action'=>'set_from_email'))))?>
                    </div>
                <?php echo FORM::close()?>
            </div>
        </div>
    </div>
<?php endif?>