<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header" id="crud-<?php echo __($name)?>">
    <h1><?php echo __('Update')?> <?php echo ucfirst(__($name))?></h1>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $form->render()?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="page-header">
                    <h3 class="panel-title"><?php echo __('Upload category icon')?></h3>
                </div>
                
                <?php if (( $icon_src = $category->get_icon() )!==FALSE ):?>
                <div class="row">
                    <div class="col-md-3">
                        <a class="thumbnail">
                            <img src="<?php echo $icon_src?>" class="img-rounded" alt="<?php echo __('Category icon')?>" height="200" style="height:200px;">
                        </a>
                    </div>
                </div>
                <?php endif?>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'category','action'=>'icon','id'=>$form->object->id_category))?>">         
                    <?php echo Form::errors()?>  
                      
                    <div class="form-group">
                        <div class="col-sm-4">
                            <?php echo  FORM::label('category_icon', __('Select from files'), array('for'=>'category_icon'))?>
                            <input type="file" name="category_icon" class="form-control" id="category_icon" />
                        </div>
                    </div>
                      
                    <button type="submit" class="btn btn-primary"><?php echo __('Submit')?></button> 
                    
                    <?php if (( $icon_src = $category->get_icon() )!==FALSE ):?>
                        <button type="submit"
                            class="btn btn-danger index-delete index-delete-inline"
                            onclick="return confirm('<?php echo __('Delete icon?')?>');" 
                            type="submit" 
                            name="icon_delete"
                            value="1" 
                            title="<?php echo __('Delete icon')?>">
                            <?php echo __('Delete icon')?>
                        </button>
                    <?php endif?>
                </form>
            </div>
        </div>
    </div>
</div>