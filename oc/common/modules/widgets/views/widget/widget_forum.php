<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->topic_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $widget->topic_title?></h3>
    </div>
<?php endif?>

<div class="panel-body">
    <ul>
        <?php foreach($widget->topic as $topic):?>
            <?php if($topic->forum->seoname != NULL):?>
                <li><a href="<?php echo Route::url('forum-topic', array('forum'=>$topic->forum->seoname,'seotitle'=>$topic->seotitle))?>" title="<?php echo HTML::chars($topic->title)?>">  
                    <?php echo $topic->title?></a>
                </li>
            <?php endif?>
        <?php endforeach?>
    </ul>
</div>