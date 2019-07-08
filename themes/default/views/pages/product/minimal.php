<?php defined('SYSPATH') or die('No direct script access.');?>

    <h2><?php echo $product->title?></h2>
    <?php if ($product->has_offer()):?>
        <p class="text-center"><span class="label label-success mb-20 "><?php echo __('Offer')?> <?php echo $product->formated_price()?> <del><?php echo $product->price.' '.$product->currency?></del></span></p>
        <p class="text-center"><?php echo __('Offer valid until')?> <?php echo (Date::format((Model_Coupon::current()->loaded())?Model_Coupon::current()->valid_date:$product->offer_valid))?></p>
    <?php else:?>
        <p class="text-center">
            <?php if($product->final_price() != 0):?>
                <span class="label label-success mb-20 "><?php echo $product->formated_price()?></span>
            <?php else:?>
                <span class="label label-success mb-20 "><?php echo __('Free')?></span>
            <?php endif?>
        </p>
    <?php endif?>

    <?php if($product->get_first_image() !== NULL):?>
    <div class="thumbnail ">
        <img src="<?php echo Core::S3_domain().$product->get_first_image('thumb')?>" class="" >
    </div>
    <?php endif?>

    <div class="button-space">
        <?php echo View::factory('pages/product/buy-button',array('product'=>$product))?>
    </div>
    
<!--     <span class="label label-info pull-right">
        <i class="icon-eye-open icon-white"></i> <?php echo $hits?>
    </span> -->

    <ul id="mini-tabs" class="nav nav-tabs">
        <li class="active"><a href="#desc" data-toggle="tab"><?php echo __('Description')?></a></li>
        <li><a href="#details" data-toggle="tab"><?php echo __('Details')?></a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="desc">
            <?php echo Text::bb2html($product->description,TRUE)?>
        </div>
        <div class="tab-pane" id="details">
            <ul class="mini-info">
                <?php if (!empty($product->file_name)):?>
                    <li>
                        <?php echo mb_strtoupper(strrchr($product->file_name, '.'))?> <?php echo __('file')?> 
                        <?php echo round(filesize(DOCROOT.'data/'.$product->file_name)/pow(1024, 2),2)?>MB
                    </li>
                <?php endif?>
                <?php if ($product->support_days>0):?>
                    <li>
                        <?php echo $product->support_days?> <?php echo __('days professional support')?>
                    </li>
                <?php endif?>
                <?php if ($product->licenses>0):?>
                    <li>
                    <?php echo $product->licenses?> <?php echo __('licenses')?> 
                        <?php if ($product->license_days>0):?>
                            <?php echo $product->license_days?> <?php echo __('days valid')?>
                        <?php endif?>
                    </li>
                <?php endif?>
            </ul>
            <div class="mt-20">
            <?php echo View::factory('coupon')?>
            </div>
        </div>
    </div>
    

<div class="clear"></div>