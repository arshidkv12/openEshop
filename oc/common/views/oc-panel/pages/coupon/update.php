<?php defined('SYSPATH') or die('No direct script access.');?>
<h1 class="page-header" id="crud"><?php echo __('Update coupon')?> <?php echo $coupon->name?></h1>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="btn-group btn-group-justified">
                    <a href="#" class="btn btn-default btn-fixed active"><?php echo __('Fixed Discount')?></a>
                    <a href="#" class="btn btn-default btn-percentage"><?php echo __('Percentage Discount')?></a>
                </div>
                <form action="<?php echo Route::url('oc-panel', array('controller'=> 'coupon', 'action'=>'update','id'=>$coupon->id_coupon)) ?>" method="post" accept-charset="utf-8" class="form form-horizontal" enctype="multipart/form-data">   

                <input type="hidden" name="id_coupon" value="" />
                    <div class="form-group ">
                    <div class="col-sm-12">
                        <label for="id_product" class="control-label"><?php echo __('Id Product')?></label>        
                        <select name="id_product">
                            <option value="" <?php echo ($coupon->id_product==NULL)?'selected="selected"':''?>><?php echo __('Any')?></option>
                            <?php foreach ($products as $key => $value) :?>
                                <option <?php echo ($coupon->id_product==$key)?'selected="selected"':''?> value="<?php echo $key?>"><?php echo $value?></option>
                            <?php endforeach?>
                        </select>                           
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-sm-12">
                        <label for="discount_amount" class="control-label"><?php echo __('Discount Amount')?></label>      
                        <input type="text" id="discount_amount" name="discount_amount" value="<?php echo $coupon->discount_amount?>" />                         
                    </div>
                </div>
                <div class="form-group hidden">
                    <div class="col-sm-12">
                        <label for="discount_percentage" class="control-label"><?php echo __('Discount Percentage')?></label>      
                        <input type="text" id="discount_percentage" name="discount_percentage" value="<?php echo $coupon->discount_percentage?>" />                         
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-sm-12">
                        <label for="valid_date" class="control-label"><?php echo __('Valid Date')?></label>        
                        <input type="text" name="valid_date" value="<?php echo $coupon->valid_date?>" placeholder="yyyy-mm-dd" data-toggle="datepicker" data-date="" data-date-format="yyyy-mm-dd" />                          
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-sm-12">
                        <label for="number_coupons" class="control-label"><?php echo __('Number of coupons')?></label>        
                        <input type="text" id="number_coupons" name="number_coupons" value="<?php echo $coupon->number_coupons?>" />                           
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="checkbox col-xs-offset-1">
                          <input type="checkbox" name="status" <?php echo ($coupon->status==TRUE)?'checked':''?>> 
                           <?php echo __('Enabled')?>
                        </label>
                    </div>
                </div>

                    
                <div class="form-actions">
                    <button type="submit" name="submit" class="btn btn-primary"><?php echo __('Submit')?></button>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>