<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1 class="forum-title pull-left"><?php echo _e("Forums")?></h1>
    
    <?php if (!Auth::instance()->logged_in()):?>
        <a class="btn btn-success pull-right" data-toggle="modal" data-dismiss="modal" 
            href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
    <?php else:?>
        <a class="btn btn-success pull-right" href="<?php echo Route::url('forum-new')?>">
    <?php endif?>
        <?php echo _e('New Topic')?></a>
    
    <?php echo View::factory('pages/forum/search-form')?>
<div class="clearfix"></div>
</div>

<table class="table table-hover" id="task-table">
    <thead>
        <tr>
            <th><?php echo _e('Forum topic')?></th>
            <th><?php echo _e('Last Message')?></th>
            <th><?php echo _e('Topics')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($forums as $f):?>
        <?php if($f['id_forum_parent'] == 0):?>
            <tr class="success">
                <td><a title="<?php echo HTML::chars($f['name'])?>" href="<?php echo Route::url('forum-list', array('forum'=>$f['seoname']))?>"><?php echo mb_strtoupper($f['name']);?></a></td>
                <td width="15%"><span class="label label-warning pull-right"><?php echo (isset($f['last_message'])?Date::format($f['last_message'], core::config('general.date_format')):'')?></span></td>
                <td width="5%"><span class="label label-success pull-right"><?php echo number_format($f['count'])?></span></td>
            </tr>
                <?php foreach($forums as $fhi):?>
                    <?php if($fhi['id_forum_parent'] == $f['id_forum']):?>
                    <tr>
                        <th><a title="<?php echo HTML::chars($fhi['name'])?>" href="<?php echo Route::url('forum-list', array('forum'=>$fhi['seoname']))?>"><?php echo $fhi['name'];?></a></th>
                        <th width="15%"><span class="label label-warning pull-right"><?php echo (isset($fhi['last_message'])?Date::format($fhi['last_message'], core::config('general.date_format')):'')?></span></th>
                        <th width="5%"><span class="label label-success pull-right"><?php echo number_format($fhi['count'])?></span></th>
                    </tr>
                    <?php endif?>
                <?php endforeach?>
            <?php endif?>
        <?php endforeach?>
    </tbody>
</table>


