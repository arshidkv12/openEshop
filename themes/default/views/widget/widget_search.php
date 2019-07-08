<?php defined('SYSPATH') or die('No direct script access.');?>
<h3><?php echo $widget->text_title?></h3>
<div>
<?php echo  FORM::open(Route::url('search'), array('class'=>'form-horizontal', 'method'=>'GET', 'action'=>'','enctype'=>'multipart/form-data'))?>
<!-- if categories on show selector of categories -->
    <div class="form-group">
        <div class="col-xs-10">  
            <?php echo  FORM::label('product', __('Product Title'), array('class'=>'', 'for'=>'product'))?>
            <input type="text" id="title" name="title" class="form-control" value="" placeholder="<?php echo __('Search')?>">
        </div>
    </div>
<?php if($widget->advanced != FALSE):?>
    <?php if($widget->cat_items !== NULL):?>
        <div class="form-group">
            <div class="col-xs-10">
                <?php echo  FORM::label('category', __('Categories'), array('class'=>'', 'for'=>'category_widget_search'))?>
                <select data-placeholder="<?php echo __('Categories')?>" name="category" id="category_widget_search" class="form-control">
                <option value="<?php echo core::request('category')?>"></option>
                <?php function lili_search($item, $key,$cats){?>
                <?php if ( count($item)==0 AND $cats[$key]['id_category_parent'] != 1):?>
                <option value="<?php echo $cats[$key]['seoname']?>" data-id="<?php echo $cats[$key]['id']?>" <?php echo (core::request('category') == $cats[$key]['seoname'])?"selected":''?> ><?php echo $cats[$key]['name']?></option>
                
                <?php endif?>
                    <?php if ($cats[$key]['id_category_parent'] == 1 OR count($item)>0):?>
                    <option value="<?php echo $cats[$key]['seoname']?>" <?php echo (core::request('category') == $cats[$key]['seoname'])?"selected":''?>> <?php echo $cats[$key]['name']?> </option>
                        <optgroup label="<?php echo $cats[$key]['name']?>">  
                        <?php if (is_array($item)) array_walk($item, 'lili_search', $cats);?>
                        </optgroup>
                    <?php endif?>
            <?php  } ?>
                $cat_order = $widget->cat_order_items; 
                if (is_array($cat_order))
                    array_walk($cat_order , 'lili_search', $widget->cat_items);?>
                </select> 
            </div>
        </div>
    <?php endif?>
<!-- end categories/ -->

    
        <div class="form-group">
             
            <div class="col-xs-10"> 
                <label class="" for="price-min"><?php echo __('Price from')?> </label>
                <input type="text" id="price-min" name="price-min" class="form-control" value="<?php echo core::get('price-min')?>" placeholder="<?php echo __('Price from')?>">
            </div>
        </div>

        <div class="form-group">
            
            <div class="col-xs-10">
                <label class="" for="price-max"><?php echo __('Price to')?></label>
                <input type="text" id="price-max" name="price-max" class="form-control" value="<?php echo core::get('price-max')?>" placeholder="<?php echo __('to')?>">
            </div>
        </div>
    
<?php endif?>

<!-- /endcustom fields -->
<div class="clearfix"></div>

    <?php echo  FORM::button('submit', __('Search'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('search')))?> 
<?php echo  FORM::close()?>
</div>
