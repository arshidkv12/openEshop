<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Breadcrumbs
 *
 * @author Kieran Graham
 */
?>
<?php if (count($breadcrumbs) > 0) : ?>
<ul id="breadcrumbs">
<?php foreach ($breadcrumbs as $crumb) : ?>
<?php if ($crumb->get_url() !== NULL) :  ?>
	<li><a href="<?php echo $crumb->get_url()?>"><?php echo $crumb->get_title()?></a></li>
<?php else : ?>
	<li><?php echo $crumb->get_title()?></li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
<?php endif; ?>