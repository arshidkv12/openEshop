<?php if (Valid::url($product->url_buy)):?>
    <a target="_blank" class="btn btn-success btn-large full-w"
        href="<?php echo $product->url_buy?>">
<?php elseif (!Auth::instance()->logged_in()):?>
    <a class="btn btn-success btn-large full-w" data-toggle="modal" data-dismiss="modal" 
        href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'register'))?>#register-modal">
<?php else:?>
    <a target="_blank" class="btn btn-success btn-large full-w"
        href="<?php echo Route::url('default',array('controller'=>'product','action'=>'buy','id'=>$product->id_product))?>">
<?php endif?>
    <span class="fa fa-shopping-cart"></span>
    <?php if ($product->final_price()>0):?>
        <?php echo __('Buy now')?>
    <?php elseif($product->has_file()==TRUE):?>
        <?php echo __('Free Download')?>
    <?php else:?>
        <?php echo __('Get it for Free')?>
    <?php endif?>
</a> 