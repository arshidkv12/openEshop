<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <?php if (!Auth::instance()->logged_in()):?>
        <a class="btn btn-success pull-right" data-toggle="modal" data-dismiss="modal" 
            href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
    <?php else:?>
        <a class="btn btn-success pull-right" href="<?php echo Route::url('forum-new')?>">
    <?php endif?>
        <?php echo _e('New Topic')?></a>
    <?php echo View::factory('pages/forum/search-form')?>
    <h1 class="forum-title pull-left"><?php echo _e('Search')?> <?php echo core::get('search')?></h1>
    <div class="clearfix"></div>
</div>

<?php if ($topics->count()>0):?>
    <table class="table table-hover" id="task-table">
        <tbody>
            <?php foreach($topics as $topic):?>
                <?php
                if (is_numeric($topic->id_post_parent))
                {
                    $title      = $topic->parent->title;
                    $seotitle   = $topic->parent->seotitle;
                }
                else
                {
                    $title      = $topic->title;
                    $seotitle   = $topic->seotitle;
                }
                    
                ?>
                <tr class="success">
                    <td><a title="<?php echo HTML::chars($title)?>" href="<?php echo Route::url('forum-topic', array('forum'=>$topic->forum->seoname,'seotitle'=>$seotitle))?>"><?php echo mb_strtoupper($topic->title);?></a></td>
                    <td width="10%"><a title="<?php echo HTML::chars($topic->forum->name)?>" href="<?php echo Route::url('forum-list', array('forum'=>$topic->forum->seoname))?>"><?php echo $topic->forum->name?></a></td>
                    <td width="10%"><span class="label label-info pull-right"><?php echo Date::format($topic->created, core::config('general.date_format'))?></span></td>
                    <?php if (Auth::instance()->logged_in()):?>
                        <?php if(Auth::instance()->get_user()->is_admin()):?>
                            <td width="10%">
                                <a class="label label-warning" href="<?php echo Route::url('oc-panel', array('controller'=> 'topic', 'action'=>'update','id'=>$topic->id_post)) ?>">
                                    <span class="icon-edit icon-white glyphicon glyphicon-edit"></span>
                                </a>
                            </td>
                        <?php endif?>
                    <?php endif?>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
<?php else:?>
    <h2><?php echo _e('Nothing found, sorry!')?></h2>
    <p><?php echo _e('You can try a new search or publish a new topic ;)')?></p>
<?php endif?>