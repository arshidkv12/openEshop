<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->page_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $widget->page_title?></h3>
    </div>
<?php endif?>

<div class="panel-body">
    <ul>
        <?php foreach($widget->page_items as $page):?>
            <?php if (core::config('general.contact_page')!=$page->seotitle AND core::config('general.private_site_page')!=$page->seotitle): ?>
                <li><a href="<?php echo Route::url('page',array('seotitle'=>$page->seotitle))?>" title="<?php echo HTML::chars($page->title)?>">
                    <?php echo $page->title?></a>
                </li>
            <?php endif?>
        <?php endforeach?>
    </ul>
</div>