<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if(Model_Coupon::available()):?>
<form class="well form-inline"  method="post" action="<?php echo URL::current()?>">         
    <?php if (Model_Coupon::current()->loaded()):?>
        <?php echo Form::hidden('coupon_delete',Model_Coupon::current()->name)?>
        <button type="submit" class="btn btn-warning"><?php echo __('Delete')?> <?php echo Model_Coupon::current()->name?></button>
        <p>
            <?php echo __('Discount off')?> <?php echo (Model_Coupon::current()->discount_amount==0)?round(Model_Coupon::current()->discount_percentage,0).'%':i18n::money_format(Model_Coupon::current()->discount_amount)?> <br>
            <?php echo Model_Coupon::current()->number_coupons?> <?php echo __('coupons left')?>, <?php echo __('valid until')?> <?php echo Date::format(Model_Coupon::current()->valid_date)?>.
            <?php if(Model_Coupon::current()->id_product!=NULL):?>
                <?php echo __('only valid for')?>  <a target="_blank" href="<?php echo Route::url('product', array('seotitle'=>Model_Coupon::current()->product->seotitle,'category'=>Model_Coupon::current()->product->category->seoname)) ?>">
                        <?php echo Model_Coupon::current()->product->title;?></a>.
            <?php endif?>
        </p>
    <?php else:?>
    <div class="form-group">
        <input class="form-control" type="text" name="coupon" value="<?php echo Core::get('coupon')?><?php echo Core::get('coupon')?>" placeholder="<?php echo __('Coupon Name')?>">          
    </div>
        <button type="submit" class="btn btn-primary"><?php echo __('Add')?></button>
    <?php endif?>      	
</form>
<?php endif?>