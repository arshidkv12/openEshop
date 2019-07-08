<?php defined('SYSPATH') or die('No direct script access.');?>
<h3><?php echo $widget->review_title?></h3>
<ul>

<?php foreach($widget->review as $review):?>

    <div class="media">
        <a class="pull-left">
            <img class="media-object dp img-circle" src="<?php echo $review->user->get_profile_image()?>" data-toggle="tooltip" data-placement="top" title="<?php echo HTML::chars($review->user->name)?>" width="30" height="30" style="width:30px;height:30px;" />
        </a>
        <div class="media-body">
            <h4 class="media-heading"><a href="<?php echo Route::url('product-review', array('seotitle'=>$review->product->seotitle,'category'=>$review->product->category->seoname))?>"><?php echo Text::limit_chars(Text::bb2html($review->product->title,TRUE),30, NULL, TRUE)?></a><span class="label label-warning"><?php echo $review->rate?></span></h4>
            <h5><?php echo Text::limit_chars(Text::bb2html($review->description,TRUE),30, NULL, TRUE)?></h5>
            <hr style="margin:8px auto">
        </div>
    </div>
<?php endforeach?>
</ul>




        


