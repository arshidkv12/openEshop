<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->rss_title!=''):?>
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $widget->rss_title?></h3>
	</div>
<?php endif?>

<div class="panel-body">
	<ul>
		<?php foreach ($widget->rss_items as $item):?>
			<li><a target="_blank" href="<?php echo $item['link']?>" title="<?php echo HTML::chars($item['title'])?>"><?php echo $item['title']?></a></li>
		<?php endforeach?>
	</ul>
</div>