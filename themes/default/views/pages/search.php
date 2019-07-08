<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="well clearfix">
    <h1><?php echo __('Advanced Search')?></h1>
    <?php echo  FORM::open(Route::url('search'), array('class'=>'form-search', 'method'=>'GET', 'action'=>''))?>
        <div class="row">
            <div class="">
                <div class="col-md-3 pl-0">
                    <input type="text" id="search" name="search" class="form-control" value="<?php echo HTML::chars(core::get('search'))?>" placeholder="<?php echo __('Name')?>">  
                </div>
            </div>
            <div class="">
                <div class="col-md-3 pl-0">
                    <select name="category" id="category" class="form-control remove_chzn" >
                    <option><?php echo __('Category')?></option>
                    <?php function lili($item, $key,$cats){?>
                    <option value="<?php echo $cats[$key]['seoname']?>" <?php echo (core::get('category')==$cats[$key]['seoname']?'selected':'')?> >
                        <?php echo $cats[$key]['name']?></option>
                        <?php if (count($item)>0):?>
                        <optgroup label="<?php echo HTML::chars($cats[$key]['name'])?>">    
                            <?php if (is_array($item)) array_walk($item, 'lili', $cats);?>
                        <?php endif?>
                    <?php }array_walk($order_categories, 'lili',$categories);?>
                    </select>
                </div>
            </div>
            <div class="">
                <div class="col-md-2 pl-0">
                    <input type="text" id="price-min" name="price-min" class="form-control" value="<?php echo HTML::chars(core::get('price-min'))?>" placeholder="<?php echo __('Price from')?>">
                </div>
            </div>   
            <div class="">
                <div class="col-md-2 pl-0">
                    <input type="text" id="price-max" name="price-max" class="form-control" value="<?php echo HTML::chars(core::get('price-max'))?>" placeholder="<?php echo __('to')?>">
                </div>
            </div>
            <div class="">
                <div class="col-md-2 pl-0">
                    <?php echo  FORM::button('submit', __('Search'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('search')))?> 
                </div>
            </div> 
        </div>
        

    <?php echo  FORM::close()?>
</div>

<?php if (count($products)>0):?>
    <h3><?php echo __('Search results')?></h3>
    <?php echo View::factory('pages/product/listing',array('pagination'=>$pagination,'products'=>$products,'category'=>NULL))?>
<?php endif?>
