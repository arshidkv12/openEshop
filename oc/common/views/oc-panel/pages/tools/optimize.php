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
                <a class="btn btn-primary pull-right ajax-load" href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'optimize'))?>?force=1" title="<?php echo __('Optimize')?>">
                    <?php echo __('Optimize')?>
                </a>
            </li>
        </ul>
        <h1 class="page-header page-title">
            <?php echo __('Optimize Database')?>
        </h1>
        <hr>
        <ul class="list-unstyled">
            <li><?php echo __('Database space')?> <?php echo round($total_space,2)?> KB</li>
            <li><?php echo __('Space to optimize')?> <?php echo round($total_gain,2)?> KB</li>
        </ul>
        <div class="panel panel-default">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo __('Table')?></th>
                        <th><?php echo __('Rows')?></th>
                        <th><?php echo __('Size')?> KB</th>
                        <th><?php echo __('Save size')?> KB</th>
                    </tr>
                </thead>
        
                <tbody>
                    <?php foreach ($tables as $table):?>
                        <tr class="<?php echo ($table['gain']>0)?'warning':''?>">
                            <td><?php echo $table['name']?></td>
                            <td><?php echo $table['rows']?></td>
                            <td><?php echo $table['space']?></td>
                            <td><?php echo $table['gain']?></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>