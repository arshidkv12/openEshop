<?php defined('SYSPATH') or die('No direct script access.');?>
<?php if($next_page):?><<?php echo $page->url($next_page)?>>; rel="next",<?php endif?><?php if($last_page):?><<?php echo $page->url($last_page)?>>; rel="last",<?php endif?><?php if($first_page):?><<?php echo $page->url($first_page)?>>; rel="first",<?php endif?><?php if($previous_page):?><<?php echo $page->url($previous_page)?>>; rel="previous_page",<?php endif?>