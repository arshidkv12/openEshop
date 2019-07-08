<?php defined('SYSPATH') or die('No direct script access.');?>
<?php if (count($breadcrumbs) > 0) : ?>
	<ul class="breadcrumb">
	<?php foreach ($breadcrumbs as $crumb) : ?>
		<?php if ($crumb->get_url() !== NULL) :  ?>
			<li>
				<a title="<?php echo HTML::chars($crumb->get_title())?>" href="<?php echo $crumb->get_url()?>"><?php echo $crumb->get_title()?></a>
			</li>
		<?php else : ?>
			<li class="active"><?php echo $crumb->get_title()?></li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
<?php endif; ?>