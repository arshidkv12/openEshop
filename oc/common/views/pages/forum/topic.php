<div class="page-header">
    <h1><?php echo $topic->title?></h1>
    <span class="label label-info"><?php echo $topic->user->name?> <?php echo Date::fuzzy_span(Date::mysql2unix($topic->created))?></span>
    <?php if($previous->loaded()):?>
        <a class="label" href="<?php echo Route::url('forum-topic',  array('seotitle'=>$previous->seotitle,'forum'=>$forum->seoname))?>" title="<?php echo HTML::chars($previous->title)?>">
        <i class="icon-white icon-backward glyphicon-backward glyphicon"></i> <?php echo $previous->title?></i></a>
    <?php endif?>
    <?php if($next->loaded()):?>
        <a class="label" href="<?php echo Route::url('forum-topic',  array('seotitle'=>$next->seotitle,'forum'=>$forum->seoname))?>" title="<?php echo HTML::chars($next->title)?>">
        <?php echo $next->title?> <i class="icon-white icon-forward glyphicon-forward glyphicon"></i></a>
    <?php endif?>
</div>

    <div class="col-md-3 span2">
        <div class="thumbnail highlight">
            <img src="<?php echo $topic->user->get_profile_image()?>" width="120" height="120" alt="<?php echo HTML::chars($topic->user->name)?>">
            <div class="caption">
                <p>
                    <?php if (in_array('profile', Route::all())) :?>
                        <a href="<?php echo Route::url('profile', array('seoname'=>$topic->user->seoname)) ?>">
                            <?php echo $topic->user->name?>
                        </a>
                    <?php else :?>
                        <?php echo $topic->user->name?>
                    <?php endif?>
                    <br>
                    <?php echo Date::fuzzy_span(Date::mysql2unix($topic->created))?><br>
                    <?php echo $topic->created?>
                </p>
            </div>
        </div> 
    </div>
    <div class="col-md-9 span6">
        <?php if(Auth::instance()->logged_in()):?>
            <?php if(Auth::instance()->get_user()->is_admin()):?>
                <a class="label label-warning pull-right" href="<?php echo Route::url('oc-panel', array('controller'=> 'topic', 'action'=>'update','id'=>$topic->id_post)) ?>">
                    <i class="glyphicon icon-white icon-edit glyphicon-edit"></i>
                </a>
            <?php endif?>
        <?php endif?>
        <div class="text-description"><?php echo Text::bb2html($topic->description,TRUE)?></div>
        <?php if (Auth::instance()->logged_in()):?>
            <a  class="btn btn-primary" href="#reply_form"><?php echo _e('Reply')?></a>
        <?php else:?>
            <a class="btn btn-primary" data-toggle="modal" data-dismiss="modal" href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
                <?php echo _e('Reply')?>
            </a>
        <?php endif?>
    </div>
<div class="clearfix"></div>
<div class="page-header"></div>

<?php foreach ($replies as $reply):?>

    <div class="col-md-3 span2">
        <div class="thumbnail highlight">
            <img src="<?php echo $reply->user->get_profile_image()?>" width="120" height="120" alt="<?php echo HTML::chars($reply->user->name)?>">
            <div class="caption">
                <p>
                    <?php if (in_array('profile', Route::all())) :?>
                        <a href="<?php echo Route::url('profile', array('seoname'=>$reply->user->seoname)) ?>">
                            <?php echo $reply->user->name?>
                        </a>
                    <?php else :?>
                        <?php echo $reply->user->name?>
                    <?php endif?>
                    <br>
                    <?php echo Date::fuzzy_span(Date::mysql2unix($reply->created))?><br>
                    <?php echo $reply->created?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9 span6">
    <?php if(Auth::instance()->logged_in()):?>
        <?php if(Auth::instance()->get_user()->is_admin()):?>
            <a class="label label-warning pull-right" href="<?php echo Route::url('oc-panel', array('controller'=> 'topic', 'action'=>'update','id'=>$reply->id_post)) ?>">
                <i class="glyphicon icon-white icon-edit glyphicon-edit"></i>
            </a>
        <?php endif?>
    <?php endif?>
        <div class="text-description"><?php echo Text::bb2html($reply->description,TRUE)?></div>
        <a  class="btn btn-xs btn-primary" href="#reply_form"><?php echo _e('Reply')?></a>
    </div>

<div class="clearfix"></div>
<div class="page-header"></div>
<?php endforeach?>
<?php echo $pagination?>


<?php if($topic->status==Model_POST::STATUS_ACTIVE AND Auth::instance()->logged_in()):?>
<form class="well form-horizontal" id="reply_form" method="post" action="<?php echo Route::url('forum-topic',array('seotitle'=>$topic->seotitle,'forum'=>$forum->seoname))?>"> 
<h3><?php echo _e('Reply')?></h3>
  <?php if ($errors): ?>
    <p class="message"><?php echo _e('Some errors were encountered, please check the details you entered.')?></p>
    <ul class="errors">
        <?php foreach ($errors as $message): ?>
            <li><?php echo $message ?></li>
        <?php endforeach ?>
    </ul>
    <?php endif?>       

    <div class="form-group control-group">
        <div class="col-md-12">
            <textarea name="description" rows="10" class="form-control input-xxlarge" required><?php echo core::post('description',_e('Reply here'))?></textarea>
        </div>
    </div>

    <?php if (core::config('advertisement.captcha') != FALSE OR core::config('general.captcha') != FALSE):?>
    <div class="form-group">
            <div class="col-md-4">
                <?php if (Core::config('general.recaptcha_active')):?>
                    <?php echo Captcha::recaptcha_display()?>
                    <div id="recaptcha1"></div>
                <?php else:?>
                    <?php echo _e('Captcha')?>*:<br />
                    <?php echo captcha::image_tag('new-reply-topic')?><br />
                    <?php echo  FORM::input('captcha', "", array('class' => 'form-control', 'id' => 'captcha', 'required'))?>
                <?php endif?>
            </div>
    </div>
    <?php endif?>

    <button type="submit" class="btn btn-primary" name="submit"><?php echo _e('Reply')?></button>
</form>  
<?php else:?>
<a class="btn btn-success pull-right" data-toggle="modal" data-dismiss="modal" 
        href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
        <?php echo _e('Login to reply')?>
</a>
<?php endif?>  

