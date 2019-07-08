<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="col-md-3 col-sm-12 col-xs-12"> 
    <?php foreach ( Widgets::render('sidebar') as $widget):?>
        <div class="panel panel-sidebar <?php echo get_class($widget->widget)?>">
            <?php echo $widget?>
        </div>
    <?php endforeach?>
</div>