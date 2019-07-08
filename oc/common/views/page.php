<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
    <h1><?php echo $page->title?></h1>
</div>

<div class="text-description">
	<?php echo Text::bb2html($page->description,TRUE,FALSE)?>
</div><!-- /well -->
