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
                <a class="btn btn-primary ajax-load" title="<?php echo __('Sitemap')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'sitemap'))?>?force=1">
                    <?php echo __('Generate')?>
                </a>
            </li>
        </ul>
        <h1 class="page-header page-title">
            <?php echo __('Sitemap')?>
            <a target="_blank" href="https://docs.yclas.com/sitemap-classifieds-website/">
                <i class="fa fa-question-circle"></i>
            </a>
        </h1>
        <hr>
        <ul class="list-unstyled">
            <li><?php echo __('Last time generated')?> <?php echo Date::unix2mysql(Sitemap::last_generated_time())?></li>
            <li><?php echo __('Your sitemap XML to submit to engines')?></li>
            <li><input type="text" value="<?php echo core::config('general.base_url')?><?php echo (file_exists(DOCROOT.'sitemap-index.xml'))? 'sitemap-index.xml':'sitemap.xml.gz'?>" /></li>
        </ul>
    </div>
</div>