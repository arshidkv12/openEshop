<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?php echo __('Welcome')?> <?php echo Auth::instance()->get_user()->name?></h1>
    <p><?php echo __('Thanks for using Open eShop.')?> 
        <?php echo __('Your installation version is')?> <span class="label label-info"><?php echo core::VERSION?></span> 
        <a class="btn btn-xs btn-primary pull-right" href="<?php echo Route::url('oc-panel',array('controller'=>'update','action'=>'index'))?>?reload=1">
                        <?php echo __('Check for updates')?></a>

    </p>
</div>

<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Latest News')?></h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($rss as $item):?>
                        <a class="list-group-item" target="_blank" href="<?php echo $item['link']?>" title="<?php echo HTML::chars($item['title'])?>"><?php echo $item['title']?></a>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tweets by @openeshop</h3>
            </div>
            <div class="panel-body">
                <a class="twitter-timeline" href="https://twitter.com/openeshop" target="_blank" data-widget-id="420496085346299904">Tweets by @openeshop</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Open-eShop on Facebook</h3>
            </div>
            <div class="panel-body">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fopeneshop&amp;width=350&amp;height=600&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=true&amp;appId=181472118540903" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:600px;" allowTransparency="true"></iframe>
            </div>
        </div>
    </div>
</div>