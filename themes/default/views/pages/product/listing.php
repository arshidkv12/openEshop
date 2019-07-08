<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <?php if ($category!==NULL):?>
        <h1><?php echo $category->name?></h1>
        <?php if(( $icon_src = $category->get_icon() )!==FALSE ):?>
            <img src="<?php echo $icon_src?>" class="img-responsive" alt="<?php echo HTML::chars($category->name)?>">
        <?php endif?>
        <?php if (strlen($category->description)>0):?>
            <div class="well advise clearfix" id="advise">
                <p><?php echo $category->description?></p>
            </div><!--end of advise-->
        <?php endif?>
    <?php else:?>
        <h1><?php echo __('Listing')?></h1>
    <?php endif?>
</div>

<div class="btn-group pull-right">
        <a href="#" id="list" class="btn btn-default btn-sm <?php echo (core::cookie('list/grid')==1)?'active':''?>">
            <span class="glyphicon glyphicon-th-list"></span><?php echo __('List')?>
        </a> 
        <a href="#" id="grid" class="btn btn-default btn-sm <?php echo (core::cookie('list/grid')==0)?'active':''?>">
            <span class="glyphicon glyphicon-th"></span><?php echo __('Grid')?>
        </a>
        <button type="button" id="sort" data-sort="<?php echo core::request('sort')?>" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-list-alt"></span><?php echo __('Sort')?> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" id="sort-list">
            <li><a href="?sort=title-asc"><?php echo __('Name (A-Z)')?></a></li>
            <li><a href="?sort=title-desc"><?php echo __('Name (Z-A)')?></a></li>
            <li><a href="?sort=price-asc"><?php echo __('Price (Low)')?></a></li>
            <li><a href="?sort=price-desc"><?php echo __('Price (High)')?></a></li>
            <li><a href="?sort=featured"><?php echo __('Featured')?></a></li>
            <li><a href="?sort=published-desc"><?php echo __('Newest')?></a></li>
            <li><a href="?sort=published-asc"><?php echo __('Oldest')?></a></li>
        </ul>
    </div>
<div class="clearfix"></div><br>
<?php if(count($products)):?>

    <div id="products" class="row list-group">
        <?php $i=1;
        foreach($products as $product ):?>    
            <div class="item <?php echo (core::cookie('list/grid')==1)?'list-group-item':'grid-group-item'?> col-xs-4 col-lg-4">
                <div class="thumbnail">
                    <a title="<?php echo HTML::chars($product->title)?>" href="<?php echo Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>">
                    <?php if($product->get_first_image() !== NULL):?>
                        <?php echo HTML::picture(Core::S3_domain().$product->get_first_image('image'), ['w' => 292, 'h' => 292], ['1200px' => ['w' => '210', 'h' => '210'], '992px' => ['w' => '292', 'h' => '292']], ['alt' => HTML::chars($product->title)])?>
                    <?php elseif(( $icon_src = $product->category->get_icon() )!==FALSE ):?>
                        <?php echo HTML::picture($icon_src, ['w' => 292, 'h' => 292], ['1200px' => ['w' => '210', 'h' => '210'], '992px' => ['w' => '292', 'h' => '292']], ['alt' => HTML::chars($product->title)])?>
                    <?php else:?>
                        <img src="//www.placehold.it/292x292&text=<?php echo urlencode($product->category->name)?>" width="300" height="200" alt="<?php echo HTML::chars($product->title)?>">
                    <?php endif?>
                    </a>
                    <div class="caption">
                        <h4><a href="<?php echo Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>"><?php echo substr($product->title, 0, 30)?></a></h4>
                        <p><?php echo Text::limit_chars(Text::removebbcode($product->description), (core::cookie('list/grid')==1)?255:30, NULL, TRUE)?></p>
                        <a class="btn btn-success" href="<?php echo Route::url('product', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>">
                        <span class="fa fa-shopping-cart"></span>
                        <?php if ($product->final_price()>0):?>
                            <?php echo __('Buy Now')?> <?php echo $product->formated_price()?>
                        <?php elseif($product->has_file()==TRUE):?>
                            <?php echo __('Free Download')?>
                        <?php else:?>
                            <?php echo __('Get it for Free')?>
                        <?php endif?>
                        </a>
                        <?php if(core::config('product.number_of_orders')):?>
                            <div class="pull-right">
                                <p><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $product->number_of_orders()?></p>
                            </div>
                        <?php endif?>
                    </div>
                </div>
            </div>
            <?php if($i%3==0):?><div class="clearfix"></div><?php endif?>
        <?php $i++?>
        <?php endforeach?>
    </div>

<?php echo $pagination?>
<?php elseif (count($products) == 0):?>
<!-- Case when we dont have products for specific category / location -->
<div class="page-header">
    <h3><?php echo __('We do not have any product in this category')?></h3>
</div>

<?php endif?>
