<?php defined('SYSPATH') or die('No direct script access.');?>
<form class="pull-right" action="<?php echo Route::URL('blog')?>" method="get">
    <button class="btn btn-default pull-right" type="submit" value="<?php echo __('Search')?>"><?php echo _e('Search')?></button>
    <div class="pull-right">&nbsp;</div>
    <div class="pull-right">
        <input type="text" class="form-control" placeholder="<?php echo __('Search')?>" type="search" value="<?php echo core::get('search')?>" name="search" />
    </div>
</form>

<div class="page-header">
    <h1><?php echo Core::config('general.site_name')?> <?php echo _e('Blog')?></h1>
</div>

<?php if(count($posts)):?>
    <?php foreach($posts as $post ):?>
    <article class="list well clearfix">
    	<h2>
    		<a title="<?php echo HTML::chars($post->title)?>" href="<?php echo Route::url('blog', array('seotitle'=>$post->seotitle))?>"> <?php echo $post->title; ?></a>
    	</h2>
    	
    	<?php echo Date::format($post->created, core::config('general.date_format'))?>
        
    	<div class="text-description blog-description"><?php echo Text::truncate_html($post->description, 255, NULL)?></div>
    	
	    <a title="<?php echo HTML::chars($post->title)?>" href="<?php echo Route::url('blog', array('seotitle'=>$post->seotitle))?>"><i class="glyphicon glyphicon-share"></i><?php echo _e('Read more')?></a>
    	<?php if ($user !== NULL AND $user!=FALSE AND $user->is_admin()):?>
    		<br />
			<a href="<?php echo Route::url('oc-panel', array('controller'=>'blog','action'=>'update','id'=>$post->id_post))?>"><?php echo _e("Edit");?></a> |
			<a href="<?php echo Route::url('oc-panel', array('controller'=>'blog','action'=>'delete','id'=>$post->id_post))?>" 
				onclick="return confirm('<?php echo __('Delete?')?>');"><?php echo _e("Delete");?></a>
        <?php endif?>
    </article>
    <?php endforeach?>
    <?php echo $pagination?>
<?php else:?>
<!-- Case when we dont have ads for specific category / location -->
	<div class="page-header">
	   <h3><?php echo _e('We do not have any blog posts')?></h3>
    </div>
<?php endif?>
