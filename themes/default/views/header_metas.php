<meta charset="<?php echo Kohana::$charset?>">
<?php if (isset($_SERVER['HTTP_USER_AGENT']) and (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) : ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php endif;?>

<title><?php echo $title?></title>
<meta name="keywords" content="<?php echo $meta_keywords?>" >
<meta name="description" content="<?php echo HTML::chars($meta_description)?>" >
<meta name="copyright" content="<?php echo HTML::chars($meta_copyright)?>" >
<?php if (Theme::get('premium')==1):?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php else:?>
<meta name="author" content="open-eshop.com">
<?php endif?>
<meta name="application-name" content="<?php echo core::config('general.site_name')?>" data-baseurl="<?php echo core::config('general.base_url')?>">

<?php if (Controller::$image!==NULL):?>
<meta property="og:image"   content="<?php echo core::config('general.base_url').Controller::$image?>"/>
<?php elseif(Theme::get('logo_url')!=NULL):?>
<meta property="og:image"   content="<?php echo Theme::get('logo_url')?>"/>
<?php endif?>
<meta property="og:title"   content="<?php echo HTML::chars($title)?>"/>
<meta property="og:description"   content="<?php echo HTML::chars($meta_description)?>"/>
<meta property="og:url"     content="<?php echo URL::current()?>"/>
<meta property="og:site_name" content="<?php echo HTML::chars(core::config('general.site_name'))?>"/>

<?php if (core::config('general.disallowbots')=='1'):?>
    <meta name="robots" content="noindex,nofollow,noodp,noydir" />
    <meta name="googlebot" content="noindex,noarchive,nofollow,noodp" />
    <meta name="slurp" content="noindex,nofollow,noodp" />
    <meta name="bingbot" content="noindex,nofollow,noodp,noydir" />
    <meta name="msnbot" content="noindex,nofollow,noodp,noydir" />
<?php endif?>

<?php if (core::config('general.blog')==1):?>
<link rel="alternate" type="application/atom+xml" title="RSS Blog <?php echo HTML::chars(Core::config('general.site_name'))?>" href="<?php echo Route::url('rss-blog')?>" />
<?php endif?>

<?php if (core::config('general.forums')==1):?>
<link rel="alternate" type="application/atom+xml" title="RSS Forum <?php echo HTML::chars(Core::config('general.site_name'))?>" href="<?php echo Route::url('rss-forum')?>" />
  <?php if (Model_Forum::current()->loaded()):?>
  <link rel="alternate" type="application/atom+xml" title="RSS Forum <?php echo HTML::chars(Core::config('general.site_name').' - '.Model_Forum::current()->name)?>" href="<?php echo Route::url('rss-forum', array('forum'=>Model_Forum::current()->seoname))?>" />
  <?php endif?>
<?php endif?>
<link rel="alternate" type="application/atom+xml" title="RSS <?php echo HTML::chars(Core::config('general.site_name'))?>" href="<?php echo Route::url('rss')?>" />

<?php if (Model_Category::current()->loaded()):?>
<link rel="alternate" type="application/atom+xml"  title="RSS <?php echo HTML::chars(Core::config('general.site_name').' - '.Model_Category::current()->name)?>"  href="<?php echo Route::url('rss',array('category'=>Model_Category::current()->seoname))?>" />
<?php endif?>  



<link rel="shortcut icon" href="<?php echo (Theme::get('favicon_url')!='') ? Theme::get('favicon_url') : core::config('general.base_url').'images/favicon.ico'?>">