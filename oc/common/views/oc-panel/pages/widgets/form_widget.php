<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if (!$widget->loaded):?>
    <div class="col-md-4 widget-boxes">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b><?php echo $widget->title?></b>
            </div>
            <div class="panel-body">
                <p><?php echo $widget->description?></p>
                <button  class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_<?php echo $widget->id_name()?>" type="button">
                        <?php echo __('Create')?>
                </button>
            </div>
        </div>
    </div> 
<?php else:?>
    <li class="liholder" id="<?php echo $widget->id_name()?>"><i class="glyphicon glyphicon-move"></i>  <?php echo $widget->title()?> <span class="muted"><?php echo $widget->title?></span>
        <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#modal_<?php echo $widget->id_name()?>" type="button"><?php echo __('Edit')?></button>
    </li>
<?php endif?>

<div id="modal_<?php echo $widget->id_name()?>" class="modal fade" role="dialog" aria-labelledby="modal_<?php echo $widget->id_name()?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $widget->title?></h4>
            </div>
            <div class="modal-body">
                <h5><?php echo $widget->description?></h5>
                <form id="form_widget_<?php echo $widget->id_name()?>" name="form_widget_<?php echo $widget->id_name()?>" method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'widget','action'=>'save'))?>" >
                    
                    <div class="form-group">
                        <label class="control-label" for="placeholder_form"><?php echo __('Where do you want the widget displayed?')?></label>
                        <?php echo FORM::select('placeholder', array_combine(widgets::get_placeholders(TRUE),widgets::get_placeholders(TRUE)),$widget->placeholder)?>
                    </div>

            		<?php foreach ($tags as $tag):?>
                        <div class="form-group">
                            <?php echo $tag?>
                        </div>
            		<?php endforeach?>

            		<?php if ($widget->loaded):?>
                        <input type="hidden" name="widget_name" value="<?php echo $widget->widget_name?>" >
            		<?php endif?>
                    <input type="hidden" name="widget_class" value="<?php echo get_class($widget)?>" >
            	</form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" ><?php echo __('Close')?></button>
                
                <?php if ($widget->loaded):?>
                    <a
                        href="<?php echo Route::url('oc-panel',array('controller'=>'widget','action'=>'remove','id'=>$widget->widget_name))?>" 
                        class="btn btn-danger pull-left" 
                        title="<?php echo __('Sure you want to delete the widget?')?>" 
                        data-toggle="confirmation" 
                        data-href="<?php echo Route::url('oc-panel',array('controller'=>'widget','action'=>'remove','id'=>$widget->widget_name))?>" 
                        data-title="<?php echo __('You can move it to the inactive placeholder')?>" 
                        data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                        data-btnCancelLabel="<?php echo __('No way!')?>">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                <?php endif?>

                <button onclick="form_widget_<?php echo $widget->id_name()?>.submit();" class="btn btn-primary"><?php echo __('Save changes')?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->