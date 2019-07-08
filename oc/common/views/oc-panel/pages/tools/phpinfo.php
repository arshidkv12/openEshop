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
        <h1 class="page-header page-title">
            <?php echo __('PHP Info')?>
        </h1>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
            	<?php echo $phpinfo?>
            </div>
        </div>
    </div>
</div>