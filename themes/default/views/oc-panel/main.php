<?php defined('SYSPATH') or die('No direct script access.');?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo i18n::html_lang()?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo i18n::html_lang()?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo i18n::html_lang()?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo i18n::html_lang()?>"> <!--<![endif]-->
<head>
	<meta charset="<?php echo Kohana::$charset?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="noindex,nofollow,noodp,noydir" /><meta name="googlebot" content="noindex,noarchive,nofollow,noodp" /><meta name="slurp" content="noindex,nofollow,noodp" /><meta name="bingbot" content="noindex,nofollow,noodp,noydir" /><meta name="msnbot" content="noindex,nofollow,noodp,noydir" />

	<title><?php echo $title?></title>
    <meta name="keywords" content="<?php echo $meta_keywords?>" >
    <meta name="description" content="<?php echo $meta_description?>" >
    <meta name="copyright" content="<?php echo $meta_copyright?>" >
	<meta name="author" content="open-eshop.com">
	<meta name="application-name" content="<?php echo core::config('general.site_name')?>" data-baseurl="<?php echo core::config('general.base_url')?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    
    <?php echo Theme::styles($styles,'default')?>	
	<?php echo Theme::scripts($scripts,'header','default')?>
    <link rel="shortcut icon" href="<?php echo core::config('general.base_url').'images/favicon.ico'?>">

  </head>

  <body>
	<?php echo $header?>
	    
		<?php echo (core::get('print')==1)?'':View::factory('oc-panel/sidebar',array('user'=>$user))?>
    <div class="bs-docs-nav">
    <div class="alert alert-warning off-line" style="display:none;"><strong><?php echo __('Warning')?>!</strong> <?php echo __('We detected you are currently off-line, please connect to gain full experience.')?></div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main pull-left" id="content">
				<?php echo (core::get('print')==1)?'':Breadcrumbs::render('oc-panel/breadcrumbs')?>      
				<?php echo Alert::show()?>
                <?php if (!isset($_COOKIE['donation_alert'])  AND Theme::get('premium')!=1 AND $user->id_role==Model_Role::ROLE_ADMIN):?>
                   <div class="alert alert-warning fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick='setCookie("donation_alert",1,7)'>×</button>
                    <h4><?php echo __('Help us to improve!')?></h4>
                    <p><?php echo __('Open eShop it´s an amazing free Open Source Software. With a small donation you are helping us to keep the project alive and updated. Thanks!')?></p>
                    <p>
                      <a href="http://j.mp/thanksdonate" onclick='setCookie("donation_alert",1,30)'>
                            <img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" alt="">
                      </a>
                      <?php echo __('Or')?>
                      <a href="<?php echo Route::url('oc-panel',array('controller'=>'market'))?>" class="btn btn-success">
                        <i class="glyphicon glyphglyphicon glyphicon-gift"></i> <?php echo __('Buy a Theme')?>
                       </a>
                    </p>
                  </div>
                <?php endif?>
				<?php echo $content?>
                <?php echo (Kohana::$environment === Kohana::DEVELOPMENT AND core::get('print')!=1)? View::factory('profiler'):''?>
        </div><!--/span--> 

    </div><!--/.fluid-->
    <div class="clearfix"></div>
    <?php echo $footer?>

	<?php echo Theme::scripts($scripts,'footer','default')?>
  </body>
</html>

