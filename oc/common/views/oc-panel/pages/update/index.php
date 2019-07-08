<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if ($latest_version!=core::VERSION):?>
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading"><?php echo __('Update')?></h4>
        <p>
            <?php echo __('You are not using latest version, please update.')?>
        </p>

        <a class="btn btn-warning ajax-load" href="<?php echo Route::url('oc-panel',array('controller'=>'update','action'=>'confirm'))?>" title="<?php echo __('Update')?>">
            <span class="glyphicon  glyphicon-refresh"></span> <?php echo __('Update')?>
        </a>
    </div>
<?php endif?>

<ul class="list-inline pull-right">
    <li>
        <a class="btn btn-primary ajax-load" href="<?php echo Route::url('oc-panel',array('controller'=>'update','action'=>'index'))?>?reload=1" title="<?php echo __('Check for updates')?>">
            <span class="glyphicon  glyphicon-refresh"></span> <?php echo __('Check for updates')?>
        </a>
    </li>
</ul>

<h1 class="page-header page-title"><?php echo __('Updates')?></h1>

<hr>

<p>
    <?php echo __('Your installation version is')?> <span class="label label-info"><?php echo core::VERSION?></span>
</p>
<p>
    <?php echo __('Your Hash Key for this installation is')?> <span class="label label-info"><?php echo core::config('auth.hash_key')?></span>
</p>

<div class="panel panel-default">
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th class="sorting_disabled"><?php echo __('Version')?></th>
                <th class="sorting_disabled hidden-xs"><?php echo __('Name')?></th>
                <th class="sorting_disabled hidden-xs"><?php echo __('Release Date')?></th>
                <th class="sorting_disabled hidden-sm hidden-xs"><?php echo __('Changelog')?></th>
                <th class="sorting_disabled hidden-sm hidden-xs"><?php echo __('Release Notes')?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($versions as $version=>$values):?> 
                <tr>
                    <td>
                        <?php echo $version?>
                        <?php echo ($version==$latest_version)? '<span class="label label-success">'.__('Latest').'</span>':''?>
                        <?php echo ($version==core::VERSION)? '<span class="label label-info">'.__('Current').'</span>':''?>
                    </td>
                    <td class="hidden-xs">
                        <?php echo $values['codename']?>    
                    </td>
                    <td class="hidden-xs">
                        <?php echo $values['released']?>
                    </td>
                    <td class="hidden-sm hidden-xs">
                        <a target="_blank" href="<?php echo $values['changelog']?>"><?php echo __('Changelog')?></a>
                    </td>
                    <td class="hidden-sm hidden-xs">
                        <a target="_blank" href="<?php echo $values['blog']?>"><?php echo __('Release Notes')?></a>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>