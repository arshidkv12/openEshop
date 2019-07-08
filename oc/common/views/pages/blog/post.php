<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
	<h1><?php echo  $post->title;?></h1>
</div>

<div class="well">
    <span class="label label-default"><?php echo $post->user->name?></span>
    <div class="pull-right">
        <span class="label label-info"><?php echo Date::format($post->created, core::config('general.date_format'))?></span>
    </div>    
</div>

<br/>

<div class="text-description blog-description">
    <?php echo $post->description?>
</div>  

<div class="pull-right">
    <?php if($previous->loaded()):?>
        <a class="btn btn-success" href="<?php echo Route::url('blog',  array('seotitle'=>$previous->seotitle))?>" title="<?php echo HTML::chars($previous->title)?>">
        <i class="glyphicon glyphicon-backward glyphicon"></i> <?php echo $previous->title?></i></a>
    <?php endif?>
    <?php if($next->loaded()):?>
        <a class="btn btn-success" href="<?php echo Route::url('blog',  array('seotitle'=>$next->seotitle))?>" title="<?php echo HTML::chars($next->title)?>">
        <?php echo $next->title?> <i class="glyphicon glyphicon-forward glyphicon"></i></a>
    <?php endif?>
</div>  
    
<?php echo $post->disqus()?>