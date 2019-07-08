<?php defined('SYSPATH') or die('No direct script access.');?>

<ul class="nav nav-tabs nav-tabs-simple">
    <li <?php echo (Request::current()->action()=='optimize') ? 'class="active"' : NULL?>>
        <a href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'optimize'))?>" 
            title="<?php echo HTML::chars(__('Optimize'))?>" 
            class="ajax-load">
            <?php echo __('Optimize')?>
        </a>
    </li>
    <li <?php echo (Request::current()->action()=='sitemap') ? 'class="active"' : NULL?>>
        <a href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'sitemap'))?>" 
            title="<?php echo HTML::chars(__('Sitemap'))?>" 
            class="ajax-load">
            <?php echo __('Sitemap')?>
        </a>
    </li>
    <li <?php echo (Request::current()->action()=='migration') ? 'class="active"' : NULL?>>
        <a href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'migration'))?>" 
            title="<?php echo HTML::chars(__('Migration'))?>" 
            class="ajax-load">
            <?php echo __('Migration')?>
        </a>
    </li>
    <li <?php echo (Request::current()->action()=='cache') ? 'class="active"' : NULL?>>
        <a href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'cache'))?>" 
            title="<?php echo HTML::chars(__('Cache'))?>" 
            class="ajax-load">
            <?php echo __('Cache')?>
        </a>
    </li>
    <li <?php echo (Request::current()->action()=='logs') ? 'class="active"' : NULL?>>
        <a href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'logs'))?>" 
            title="<?php echo HTML::chars(__('Logs'))?>" 
            class="ajax-load">
            <?php echo __('Logs')?>
        </a>
    </li>
    <li <?php echo (Request::current()->action()=='phpinfo') ? 'class="active"' : NULL?>>
        <a href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'phpinfo'))?>" 
            title="<?php echo HTML::chars(__('PHP Info'))?>" 
            class="ajax-load">
            <?php echo __('PHP Info')?>
        </a>
    </li>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <ul class="list-inline pull-right">
            <li>
                <a class="btn btn-warning pull-right ajax-load" href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'cache'))?>?force=1" title="<?php echo __('Delete all')?>">
                    <?php echo __('Delete all')?>
                </a>
            </li>
            <li>
                <a class="btn btn-primary pull-right ajax-load" href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'cache'))?>?force=2" title="<?php echo __('Delete expired')?>">
                    <?php echo __('Delete expired')?>
                </a>
            </li>
        </ul>
        <h1 class="page-header page-title">
            <?php echo __('Cache')?>
            <a target="_blank" href="https://docs.yclas.com/modify-cache-time/">
                <i class="fa fa-question-circle"></i>
            </a>
        </h1>
        <hr>
        <div class="panel panel-default">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo __('Config file')?></th>
                        <th><?php echo APPPATH?>config/cache.php</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cache_config as $key => $value):?>
                        <tr>
                            <td><?php echo $key?></td>
                            <td><?php echo print_r($value,1)?></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>