<?phpdefined('SYSPATH') or exit('Install must be loaded from within index.php!');?>
<br>
<div class="alert alert-success"><?php echo __('Congratulations');?></div>
<div class="jumbotron well">
    <h1><?php echo __('Installation done');?></h1>
    <p>
        <?php echo __('Please now erase the folder');?> <code>/install/</code><br>
    
        <a class="btn btn-success btn-large" href="<?php echo core::request('SITE_URL')?>"><?php echo __('Go to Your Website')?></a>
        
        <a class="btn btn-warning btn-large" href="<?php echo core::request('SITE_URL')?>oc-panel/home/">Admin</a> 
        <?php if(core::request('ADMIN_EMAIL')):?>
            <span class="help-block">user: <?php echo core::request('ADMIN_EMAIL')?> pass: <?php echo core::request('ADMIN_PWD')?></span>
        <?php endif?>
        <hr>
        <a class="btn btn-primary btn-large" href="http://j.mp/thanksdonate"><?php echo __('Make a donation')?></a>
        <?php echo __('We really appreciate it')?>.
    </p>
</div>