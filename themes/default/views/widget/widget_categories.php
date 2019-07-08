<?php defined('SYSPATH') or die('No direct script access.');?>
<h3><?php echo $widget->categories_title?></h3>

<?php if($widget->cat_breadcrumb !== NULL):?>
<h5>
	<p>
		<?php if($widget->cat_breadcrumb['id_parent'] != 0):?>
			<a href="<?php echo Route::url('list',array('category'=>$widget->cat_breadcrumb['parent_seoname']))?>" title="<?php echo $widget->cat_breadcrumb['parent_name']?>"><?php echo $widget->cat_breadcrumb['parent_name']?></a> - 
			<?php echo $widget->cat_breadcrumb['name']?>
		<?php else:?>
			<a href="<?php echo Route::url('list',array('category'=>$widget->cat_breadcrumb['parent_seoname']))?>" title="<?php echo $widget->cat_breadcrumb['parent_name']?>"><?php echo __('Home')?></a> - 
			<?php echo $widget->cat_breadcrumb['name']?>
		<?php endif?>
	</p>
</h5>
<?php endif?>
<ul>
<?php foreach($widget->cat_items as $cat):?>
    <li>
        <a href="<?php echo Route::url('list',array('category'=>$cat->seoname))?>" title="<?php echo $cat->name?>">
        <?php echo $cat->name?></a>
    </li>
<?php endforeach?>
</ul>