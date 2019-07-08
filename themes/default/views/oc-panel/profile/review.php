<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?php echo __("Review").' '.$product->title?></h1>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <?php if ($review->loaded()):?>
            <div id="rated_raty" data-score="<?php echo $review->rate?>" ></div>
            <blockquote><?php echo Text::bb2html($review->description,TRUE)?></blockquote>
        <?php else:?>
            <?php if ($errors): ?>
            <p class="message"><?php echo __('Some errors were encountered, please check the details you entered.')?></p>
            <ul class="errors">
            <?php foreach ($errors as $message): ?>
                <li><?php echo $message ?></li>
            <?php endforeach ?>
            </ul>
            <?php endif ?>       
            <?php echo FORM::open(Route::url('oc-panel',array('controller'=>'profile','action'=>'review','id'=>$order->id_order)), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'))?>
            <fieldset>
        
                <div id="review_raty"></div>
        
                <div class="control-group">
                    <?php echo  FORM::label('description', __('Review'), array('class'=>'control-label', 'for'=>'description'))?>
                    <div class="controls">
                        <?php echo  FORM::textarea('description', core::post('description',__('Review')), array('placeholder' => __('Review'), 'class' => 'span6', 'name'=>'description', 'id'=>'description', 'required'))?>   
                    </div>
                </div>
            
                <div class="control-group">
                    <div class="controls">
                        <?php echo  FORM::button('submit', __('Publish new review'), array('type'=>'submit', 'class'=>'btn btn-success', 
                        'action'=>Route::url('oc-panel',array('controller'=>'profile','action'=>'review','id'=>$order->id_order))) )?>
                    </div>
                    <br class="clear">
                </div>
            </fieldset>
            <?php echo  FORM::close()?>
        <?php endif?>
    </div>
</div>