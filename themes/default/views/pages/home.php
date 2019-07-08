<?php defined('SYSPATH') or die('No direct script access.');?>
<?php if(core::config('product.products_in_home') != 4):?>
<?php if (count($products)>0):?>

    <section class="well featured-posts">
        <?php if(core::config('product.products_in_home') == 0):?>
            <h2><?php echo __('Latest')?></h2>
        <?php elseif(core::config('product.products_in_home') == 1):?>
            <h2><?php echo __('Featured')?></h2>
        <?php elseif(core::config('product.products_in_home') == 2):?>
            <h2><?php echo __('Most popular')?></h2>
        <?php elseif(core::config('product.products_in_home') == 3):?>
            <h2><?php echo __('Best rated')?></h2>
        <?php endif?>
        <div class="row">
          <div id="slider-fixed-products" class="carousel slide">
            <div class="carousel-inner">
                <div class="active item">
                    <ul class="thumbnails">    
                    <?php $i=0;
                    foreach ($products as $product):?>
                    <?php if ($i%4==0 AND $i!=0):?></ul></div><div class="item"><ul class="thumbnails"><?php endif?>
                    <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <div class="thumbnail">
                            <a href="<?php echo Route::url('product', array('category'=>$product->category->seoname,'seotitle'=>$product->seotitle))?>" class="min-h">
                            <?php if($product->get_first_image()!== NULL):?>
                                <?php echo HTML::picture(Core::S3_domain().$product->get_first_image(), ['w' => 140, 'h' => 140], ['1200px' => ['w' => '140', 'h' => '140'], '992px' => ['w' => '200', 'h' => '200']], ['alt' => HTML::chars($product->title)])?>
                            <?php elseif(( $icon_src = $product->category->get_icon() )!==FALSE ):?>
                                <?php echo HTML::picture($icon_src, ['w' => 140, 'h' => 140], ['1200px' => ['w' => '140', 'h' => '140'], '992px' => ['w' => '200', 'h' => '200']], ['alt' => HTML::chars($product->title)])?>
                            <?php else:?>
                                <img src="//www.placehold.it/200x200&text=<?php echo $product->category->name?>" alt="<?php echo $product->title?>"> 
                            <?php endif?>
                            </a>
                          <div class="caption">
                            <h5><a href="<?php echo Route::url('product', array('category'=>$product->category->seoname,'seotitle'=>$product->seotitle))?>"><?php echo substr(Text::removebbcode($product->title), 0, 30)?></a></h5>
                            <p><?php echo substr(Text::removebbcode($product->description), 0, 30)?></p>
                            <a class="btn btn-success" href="<?php echo Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>">
                                <?php if ($product->final_price()>0):?>
                                    <?php echo $product->formated_price()?>
                                <?php elseif(!empty($product->file_name)):?>
                                    <?php echo __('Free Download')?>
                                <?php else:?>
                                    <?php echo __('Get it for Free')?>
                                <?php endif?>
                            </a>
                          </div>
                        </div>
                    </li>
                    <?php $i++;
                    endforeach?>
                </ul>
              </div>
            </div>
            <a class="left carousel-control" href="#slider-fixed-products" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#slider-fixed-products" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>
    </section>

<?php endif?>
<?php endif?>

<section class="well categories clearfix">
   <h2><?php echo __("Categories")?></h2>

        <?php $i=0;
        foreach($categs as $c):?>
        <?php if($c['id_category_parent'] == 1 && $c['id_category'] != 1):?>

        <ul class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <li class="cathead">
                <?php $icon_src = new Model_Category($c['id_category']); $icon_src = $icon_src->get_icon(); if(( $icon_src )!==FALSE ):?>
                <a title="<?php echo $c['name']?>" href="<?php echo Route::url('list', array('category'=>$c['seoname']))?>">
                <img src="<?php echo $icon_src?>" alt="<?php echo $c['name']?>">
                </a>
                <?php endif?>
                <a title="<?php echo $c['name']?>" href="<?php echo Route::url('list', array('category'=>$c['seoname']))?>"><?php echo mb_strtoupper($c['name']);?> <span class="badge badge-success pull-right"><?php echo $c['count']?></span></a>
            </li>
            
            <?php foreach($categs as $chi):?>
                <?php if($chi['id_category_parent'] == $c['id_category']):?>
                <li><a title="<?php echo $chi['name']?>" href="<?php echo Route::url('list', array('category'=>$chi['seoname']))?>">
                    <?php echo $chi['name'];?> <span class="badge pull-right"><?php echo $chi['count']?></span></a>
                </li>
                <?php endif?>
             <?php endforeach?>
        </ul>
        <?php
        $i++;
            if ($i%3 == 0) echo '<div class="clear"></div>';
            endif?>
        <?php endforeach?>

</section>
