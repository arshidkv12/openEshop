<?php defined('SYSPATH') or die('No direct script access.');?>
<h3><?php echo $widget->products_title?></h3>
<ul>
<?php foreach($widget->products as $product):?>
    <li><a href="<?php echo Route::url('product',array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>" title="<?php echo HTML::chars($product->title)?>">
        <?php echo $product->title?></a>
    </li>
<?php endforeach?>
</ul>