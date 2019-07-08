<?php defined('SYSPATH') or die('No direct script access.');?>


<h1 class="page-header page-title"><?php echo __('Update')?> <?php echo $latest_version?></h1>
<hr>
    <p>
        <?php echo __('Your installation version is')?> <span class="label label-info"><?php echo core::VERSION?></span>
    </p>
    
<div class="alert alert-danger" role="alert">
<?php if ($can_update==FALSE):?>
    <h4 class="alert-heading"><?php echo __('Not possible to auto update')?></h4>
    <p>
        <?php echo __('You have an old version and automatic update is not possible. Please read the release notes and the manual update instructions.')?>
        <br>
        <a target="_blank"  class="btn btn-default" href="<?php echo $version['blog']?>"><?php echo __('Release Notes')?> <?php echo $latest_version?></a>
    </p>
<?php else:?>
    <h2 class="alert-heading"><?php echo __('Read carefully')?>!</h2>
    <p>
        <ul>
            <li><?php echo __('Backup all your files and database')?>. <a target="_blank" href="https://docs.yclas.com/backup-classifieds-site/"><?php echo __('Read more')?></a></li>
            <li><?php echo __('This process can take few minutes DO NOT interrupt it')?></li>
            <li><?php echo __('If you have doubts check the release notes for this version')?>. <a target="_blank" href="<?php echo $version['changelog']?>"><?php echo __('Release Notes')?> <?php echo $latest_version?></a></li>
            <li><?php echo __('You are responsible for any damages or down time at your site')?></li>
        </ul>
    </p>
    <br>
    <a class="btn btn-warning confirm-button"
            title="<?php echo __('Are you sure you want to update?')?>" 
            data-text="<?php echo __('This process can take few minutes DO NOT interrupt it')?>"
            data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
            data-btnCancelLabel="<?php echo __('No way!')?>"
            href="<?php echo Route::url('oc-panel',array('controller'=>'update','action'=>'latest'))?>" 
    >
    <span class="glyphicon  glyphicon-refresh"></span> <?php echo __('Proceed with Update')?>
    </a>
<?php endif?>
</div>


<!--/well-->
<div class="modal modal-statc fade" id="processing-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo __('Updating, do not close this window.')?></h4>
                </div>
                <div class="modal-body">
                    <div class="progress progress-striped active">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>