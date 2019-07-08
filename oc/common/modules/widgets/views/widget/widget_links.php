<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->links_title!=''):?>
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $widget->links_title?></h3>
	</div>
<?php endif?>

<div class="panel-body">
	<ul>
		<?php foreach($widget->url as $url):?>
		<li class='widget_link_li'>
			<a target="<?php echo $widget->target?>" href="<?php echo $url[0]?>">
				<?php if(isset($url[1])):?>
					<?php echo $url[1];?>
				<?php else:?>
					<?php echo $url[0];?>
				<?php endif?>
			</a>
		</li>
		<?php endforeach?>
	</ul>
</div>