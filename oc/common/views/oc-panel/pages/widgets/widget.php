<?php defined('SYSPATH') or die('No direct script access.');?>

<h1 class="page-header page-title">
    <?php echo __('Available widgets')?>
    <a target="_blank" href="https://docs.yclas.com/overview-of-widgets/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>

<hr>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <?php $i=1?>
            <?php foreach ($widgets as $widget):?>
                <?php echo $widget->form()?>
                <?php if($i%3 == 0):?><div class="clearfix"></div><?php endif?>
            <?php $i++;endforeach?>
        </div>
    </div><!--/span--> 
    
    <!--placeholders-->
    <div class="col-md-4">
        <?php foreach ($placeholders as $placeholder=>$widgets):?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title"><?php echo $placeholder?></div>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-list plholder" id="<?php echo $placeholder?>" >
                        <?php foreach ($widgets as $widget):?>
                          <?php echo $widget->form()?>
                        <?php endforeach?>
                    </ul>
                </div>
            </div>
        <?php endforeach?>
        <span id='ajax_result' data-url='<?php echo Route::url('oc-panel',array('controller'=>'widget','action'=>'saveplaceholders'))?>'></span>
    </div>
    <!--placeholders-->
</div>