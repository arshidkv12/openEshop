<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($widget->languages_title!=''):?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $widget->languages_title?></h3>
    </div>
<?php endif?>

<div class="panel-body">
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo i18n::get_display_language(i18n::$locale)?> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php foreach($widget->languages as $language):?>
            <?php if(i18n::$locale!=$language):?>
            <li>
                <a href="<?php echo Route::url('default')?>?language=<?php echo $language?>">
                <?php echo i18n::get_display_language($language)?></a>
            </li>
            <?php endif?>
            <?php endforeach?>
        </ul>
    </div>
</div>