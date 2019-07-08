<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1 class="forum-title pull-left"><?php echo $forum->name?></h1>
    <?php if (!Auth::instance()->logged_in()):?>
    <a class="btn btn-success pull-right" data-toggle="modal" data-dismiss="modal" 
        href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
    <?php else:?>
    <a class="btn btn-success pull-right" href="<?php echo Route::url('forum-new')?>?id_forum=<?php echo $forum->id_forum?>">
    <?php endif?>
    <?php echo _e('New Topic')?></a>
    
    <?php echo View::factory('pages/forum/search-form')?>

    <div class="clearfix"></div><br>
    <div class="text-description"><?php echo Text::bb2html($forum->description,TRUE)?></div>
</div>

<table class="table table-hover" id="task-table">
    <thead>
        <tr>
            <th><?php echo _e('Topic')?></th>
            <th><?php echo _e('Created')?></th>
            <th><?php echo _e('Last Message')?></th>
            <th><?php echo _e('Replies')?></th>
            <?php if (Auth::instance()->logged_in()):?>
                <?php if(Auth::instance()->get_user()->is_admin()):?>
                    <th><?php echo _e('Edit')?></th>
                <?php endif?>
            <?php endif?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($topics as $topic):?>
            <tr class="success">
                <?php
                //amount answers a topic got
                $replies = ($topic->count_replies>0)?$topic->count_replies:0;
                $page = '';
                //lets drive the user to the last page
                if ($replies>0)
                {
                    $last_page = round($replies/Controller_Forum::$items_per_page,0);
                    $page = ($last_page>0) ?'?page=' . $last_page : '';
                }
                   
                ?>

                <td><a title="<?php echo HTML::chars($topic->title)?>" href="<?php echo Route::url('forum-topic', array('forum'=>$forum->seoname,'seotitle'=>$topic->seotitle))?><?php echo $page?>"><?php echo mb_strtoupper($topic->title);?></a></td>
                <td width="10%"><span class="label label-info pull-right"><?php echo Date::format($topic->created, core::config('general.date_format'))?></span></td>
                <td width="15%"><span class="label label-warning pull-right"><?php echo Date::format($topic->last_message, core::config('general.date_format'))?></span></td>
                <td width="5%"><span class="label label-success pull-right"><?php echo $replies?></span></td>
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

<?php echo $pagination?>