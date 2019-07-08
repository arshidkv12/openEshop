<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if(count($products)):?>
<h3><?php echo __('Related products')?></h3>
<ul class="media-list">
    <?php foreach($products as $p ):?>
    <li class="media">
        <a class="pull-left" title="<?php echo HTML::chars($p->title)?>" href="<?php echo Route::url('product', array('controller'=>'product','category'=>$p->category->seoname,'seotitle'=>$p->seotitle))?>">
            <?php if($p->get_first_image() !== NULL):?>
                <img class="media-object" width="64" height="64" src="<?php echo Core::imagefly(Core::S3_domain().$p->get_first_image(),64,64)?>" alt="<?php echo HTML::chars($p->title)?>">
            <?php elseif(( $icon_src = $p->category->get_icon() )!==FALSE ):?>
                <img class="media-object" width="64" height="64" src="<?php echo Core::imagefly($icon_src,64,64)?>" alt="<?php echo HTML::chars($p->title)?>">
            <?php else:?>
                <img src="//www.placehold.it/64x64&text=<?php echo $p->category->name?>" alt="<?php echo $p->title?>"> 
            <?php endif?>
        </a>
        <div class="media-body">
            <h4 class="media-heading">
                <?php if($p->featured >= Date::unix2mysql(time())):?>
                    <span class="label label-danger pull-right"><?php echo __('Featured')?></span>
                <?php endif?>
                <a title="<?php echo HTML::chars($p->title)?>" href="<?php echo Route::url('product', array('controller'=>'product','category'=>$p->category->seoname,'seotitle'=>$p->seotitle))?>"> <?php echo $p->title; ?></a>
            </h4>
            <p><?php echo Text::limit_chars(Text::removebbcode($p->description),255,NULL,TRUE);?></p>
        </div>
    </li>
    <?php endforeach?>
</ul>
<?php endif?>