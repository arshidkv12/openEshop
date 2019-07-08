<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
    <a class="btn btn-primary pull-right" href="<?php echo Route::url('oc-panel',array('controller'=>'category','action'=>'create'))?>">
        <?php echo __('New category')?>
    </a>
    <h1><?php echo __('Categories')?></h1>
    <p><?php echo __("Change the order of your categories. Keep in mind that more than 2 levels nested probably won´t be displayed in the theme (it is not recommended).")." <a target='_blank' href='http://open-classifieds.com/2013/08/12/how-to-add-categories/'>".__('Read more')."</a>"?></p>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <span class="label label-info"><?php echo __('Heads Up!')?> <?php echo __('Quick category creator.')?></span>
                <div class="clearfix"></div> 
                <?php echo __('Add names for multiple categories, for each one push enter.')?>
                <div class="clearfix"></div><br>
            
                <?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'category','action'=>'multy_categories')), array('class'=>'form-inline', 'role'=>'form','enctype'=>'multipart/form-data'))?>
                    <div class="form-group">
                        <div class="">
                        <?php echo  FORM::label('multy_categories', __('Name').':', array('class'=>'control-label', 'for'=>'multy_categories'))?>
                        <?php echo  FORM::input('multy_categories', '', array('placeholder' => __('Hit enter to confirm'), 'class' => 'form-control', 'id' => 'multy_categories', 'type' => 'text','data-role'=>'tagsinput'))?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php echo  FORM::button('submit', __('Send'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'category','action'=>'multy_categories'))))?>
                <?php echo  FORM::close()?>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-body">
                <ol class='plholder' id="ol_1" data-id="1">
                <?php echo _('Home')?>
                <?php function lili($item, $key,$cats){?>
                    <li data-id="<?php echo $key?>" id="li_<?php echo $key?>"><i class="glyphicon glyphicon-move"></i> <?php echo $cats[$key]['name']?>
                
                        <a 
                            href="<?php echo Route::url('oc-panel', array('controller'=> 'category', 'action'=>'delete','id'=>$key))?>" 
                            class="btn btn-xs btn-danger pull-right index-delete index-delete-inline" 
                            title="<?php echo __('Are you sure you want to delete?')?>" 
                            data-id="li_<?php echo $key?>" 
                            data-text="<?php echo __('We will move the siblings categories and ads to the parent of this category.')?>" 
                            data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                            data-btnCancelLabel="<?php echo __('No way!')?>">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                
                        <a class="btn btn-xs btn-primary pull-right" 
                            href="<?php echo Route::url('oc-panel',array('controller'=>'category','action'=>'update','id'=>$key))?>">
                            <?php echo __('Edit')?>
                        </a>
                
                        <ol data-id="<?php echo $key?>" id="ol_<?php echo $key?>">
                            <?php if (is_array($item)) array_walk($item, 'lili', $cats);?>
                        </ol><!--ol_<?php echo $key?>-->
                
                    </li><!--li_<?php echo $key?>-->
                <?php }array_walk($order, 'lili',$cats);?>
                </ol><!--ol_1-->
                <span id='ajax_result' data-url='<?php echo Route::url('oc-panel',array('controller'=>'category','action'=>'saveorder'))?>'></span>
            </div>
        </div>
    </div>
</div>