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
            <?php echo __('System Logs')?>
        </h1>
        <hr>
        <p><?php echo __('Reading log file')?><code> <?php echo $file?></code></p>
                <form id="" class="form-inline" method="get" action="">
                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                <input  type="text" class="form-control" size="16" id="date" name="date"  value="<?php echo $date?>" data-date-format="yyyy-mm-dd">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <button class="btn btn-primary"><?php echo __('Log')?></button>
                    </fieldset>
                </form>
                <br>
                <textarea class="col-md-9 form-control" rows="20">
                    <?php echo $log?>
                </textarea>
    </div>
</div>