<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->text_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $widget->text_title?></h3>
    </div>
<?php endif?>

<div class="panel-body">
    <script type="text/javascript" 
    src="http://disqus.com/forums/<?php echo core::config('advertisement.disqus')?>/combination_widget.js?num_items=<?php echo $widget->comments_limit?>&hide_mods=0&default_tab=recent&excerpt_length=200">
    </script>
</div>