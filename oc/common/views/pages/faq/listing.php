<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?php echo _e('Frequently Asked Questions')?></h1>
</div>

<?php if(count($faqs)):?>
<ol class="faq-list">
    <?php foreach($faqs as $faq ):?>
    <li>
        <h4>
            <a title="<?php echo HTML::chars($faq->title)?>" href="<?php echo Route::url('faq', array('seotitle'=>$faq->seotitle))?>"> <?php echo $faq->title?></a>
        </h4>            
        <p><?php echo Text::limit_chars(Text::removebbcode($faq->description),400, NULL, TRUE);?>
            <a title="<?php echo HTML::chars($faq->title)?>" href="<?php echo Route::url('faq', array('seotitle'=>$faq->seotitle))?>"><?php echo _e('Read more')?>.</a>
        </p>
    </li>
    <?php endforeach?>
</ol>
<?php else:?>
<!-- Case when we dont have ads for specific category / location -->
    <div class="page-header">
       <h3><?php echo _e('We do not have any FAQ-s')?></h3>
    </div>
<?php endif?>

<?php echo $disqus?>