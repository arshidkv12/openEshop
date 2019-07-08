<?php defined('SYSPATH') or die('No direct script access.');?>

    
    <div class="well well-sm">
        <div class="row">
            <div class="col-xs-4 col-md-4 section-box" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
                <img itemprop="photo" alt="<?php echo HTML::chars($product->title)?>" src="<?php echo URL::base()?><?php echo $product->get_first_image()?>" >
            </div>
            <div class="col-xs-8 col-md-8 section-box" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
                <h1 ><?php echo $product->title.' '.__("Reviews")?></h1>
                <meta itemprop="itemreviewed" content="<?php echo $product->title?>" >
                <hr />
                <div class="row rating-desc">
                    <div class="col-md-8">
                        <?php for ($i=0; $i < round($product->rate); $i++):?>
                            <span class="glyphicon glyphicon-star"></span>
                        <?php endfor?>
                        <span itemprop="average"><?php echo round($product->rate,1)?>/</span>
                        <span itemprop="best"><?php echo Model_Review::RATE_MAX?></span>
                        <span class="separator">|</span>
                        <span class="glyphicon glyphicon-comment"></span><span itemprop="count"><?php echo count($reviews)?></span> <?php echo __('reviews')?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="button-space-review pull-left">
        <?php echo View::factory('pages/product/buy-button',array('product'=>$product))?>
    </div>

    <?php if (!empty($product->url_demo)):?>
        <?php if (count($skins)>0):?>
            <div class="btn-group pull-right">
                <a class="btn btn-warning btn-xs" href="<?php echo Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>"><?php echo __('Demo')?></a>
                <button class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="menu_type">
                    <?php foreach ($skins as $s):?>
                        <li><a title="<?php echo HTML::chars($s)?>" href="<?php echo Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>?skin=<?php echo $s?>"><?php echo $s?></a></li>
                    <?php endforeach?>
                </ul>
            </div>
        <?php else:?>
            <a class="btn btn-warning btn-xs pull-right" href="<?php echo Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>" >
            <i class="glyphicon glyphicon-eye-open"></i> <?php echo __('Demo')?></a>
        <?php endif?>
    <?php endif?>
    
    <div class="clearfix"></div>
    
<hgroup class="mb20"></hgroup>
<?php if(count($reviews)):?>
    <?php foreach ($reviews as $review):?>
    
    <article class="search-result row" itemscope itemtype="http://data-vocabulary.org/Review">
        <meta itemprop="itemreviewed" content="<?php echo $product->title?>" >

        <div class="col-xs-12 col-sm-12 col-md-3">
            <a title="<?php echo HTML::chars($review->user->name)?>" class="thumbnail"><img src="<?php echo $review->user->get_profile_image()?>" alt="<?php echo __('Profile image')?>" height="140"></a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2">
            <ul class="meta-search">
                <li><i class="glyphicon glyphicon-calendar"></i>
                    <time itemprop="dtreviewed" datetime="<?php echo Date::format($review->created,'Y-m-d')?>">
                        <?php echo Date::format($review->created,Core::config('general.date_format'))?>
                    </time>
                </li>
                <li><i class="glyphicon glyphicon-time"></i> <span><?php echo Date::fuzzy_span(Date::mysql2unix($review->created))?></span></li>
                <li><i class="glyphicon glyphicon-user"></i> <span itemprop="reviewer"><?php echo $review->user->name?></span></li>
            <?php if ($review->rate!==NULL):?>
        
            <div class="rating">
                <h1 class="rating-num" itemprop="rating"><?php echo round($review->rate,2)?>.0</h1>
                <?php for ($i=0; $i < round($review->rate,1); $i++):?>
                    <span class="glyphicon glyphicon-star"></span>
                <?php endfor?>
            </div>
            <?php endif?>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7">
            <p itemprop="description"><?php echo Text::bb2html($review->description,TRUE)?></p>                        
            <!-- <span class="plus"><a href="#" title="Lorem ipsum"><i class="glyphicon glyphicon-plus"></i></a></span> -->
        </div>
        <span class="clearfix borda"></span>
    </article>
    <hgroup class="mb20 mt20"></hgroup>
    <?php endforeach?>

<?php elseif (count($reviews) == 0):?>
<div class="page-header">
    <h3><?php echo __('We do not have any reviews for this product')?></h3>
</div>
<?php endif?>