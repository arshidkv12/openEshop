<?php defined('SYSPATH') or die('No direct script access.');?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo i18n::html_lang()?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo i18n::html_lang()?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo i18n::html_lang()?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo i18n::html_lang()?>"> <!--<![endif]-->

<head>
<?php echo View::factory('header_metas',array('title'             => $title,
                                      'meta_keywords'     => $meta_keywords,
                                      'meta_description'  => $meta_description,
                                      'meta_copyright'    => $meta_copyright,))?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 7]><link rel="stylesheet" href="//blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    <?php echo Theme::styles($styles)?> 
    <?php echo Theme::scripts($scripts)?>
    <?php echo core::config('general.html_head')?>
    <?php echo View::factory('analytics')?>
</head>

    <body data-spy="scroll" data-target=".subnav" data-offset="50" class="<?php echo ((Request::current()->controller()!=='faq') AND Theme::get('fixed_toolbar')==1)?'':'body_fixed'?>">
    
    <?php echo View::factory('alert_terms')?>
    
	<?php echo $header?>
    
    <div class="container bs-docs-container" id="main">
    <div class="alert alert-warning off-line" style="display:none;"><strong><?php echo __('Warning')?>!</strong> <?php echo __('We detected you are currently off-line, please login to gain full experience.')?></div>
        <div class="row">

            <?php echo (Theme::get('sidebar_position')=='left')?View::fragment('sidebar_front','sidebar'):''?>

            <section class="col-lg-9" id="page">
                <?php echo (Theme::get('breadcrumb')==1)?Breadcrumbs::render('breadcrumbs'):''?>
                <?php echo Alert::show()?>

                <div class="row">
                    <?php foreach ( Widgets::render('header') as $widget):?>
                    <div class="col-lg-9">
                        <?php echo $widget?>
                    </div>
                    <?php endforeach?>
                </div>

                <?php echo (Theme::get('header_ad')!='')?Theme::get('header_ad'):''?>
                <?php echo $content?>
            </section>

            <?php echo (Theme::get('sidebar_position')=='right')?View::fragment('sidebar_front','sidebar'):''?>
            
            <div class="container">
                <?php foreach ( Widgets::render('footer') as $widget):?>
                <div class="col-lg-3">
                    <?php echo $widget?>
                </div>
                <?php endforeach?>
            </div>


            <?php echo $footer?>
       </div>     
    </div><!--/.fluid-container-->


	<?php echo Theme::scripts($scripts,'footer')?>
	<?php echo core::config('general.html_footer')?>
	
  <?php echo (Kohana::$environment === Kohana::DEVELOPMENT)? View::factory('profiler'):''?>
  </body>
</html>
