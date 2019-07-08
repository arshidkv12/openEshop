<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="navbar navbar-default <?php echo ((Request::current()->controller()!=='faq') AND Theme::get('fixed_toolbar')==1)?'navbar-fixed-top':''?>">
    <div class="container resiz-cont">

        <div class="btn-group pull-right btn-header-group">
            <?php echo View::factory('widget_login')?>         
        </div>
        
        <div class="navbar-collapse bs-navbar-collapse collapse" id="mobile-menu-panel">
            <ul class="nav navbar-nav">
            <?php if (class_exists('Menu') AND count( $menus = Menu::get() )>0 ):?>
                <?php foreach ($menus as $menu => $data):?>
                    <li class="<?php echo (Request::current()->uri()==$data['url'])?'active':''?>" >
                    <a href="<?php echo $data['url']?>" target="<?php echo $data['target']?>">
                        <?php if($data['icon']!=''):?><i class="<?php echo $data['icon']?>"></i> <?php endif?>
                        <?php echo $data['title']?></a> 
                    </li>
                <?php endforeach?>
            <?php else:?>
                <li class="<?php echo (Request::current()->controller()=='home')?'active':''?>" >
                    <a href="<?php echo Route::url('default')?>"><i class="glyphicon glyphicon-home "></i> <?php echo __('Home')?></a> </li>
                <?php echo Theme::nav_link(__('Listing'),'ad', 'glyphicon glyphicon-list ' ,'listing', 'list')?>
                <?php if (core::config('general.blog')==1):?>
                    <?php echo Theme::nav_link(__('Blog'),'blog','glyphicon glyphicon-file','index','blog')?>
                <?php endif?>
                <?php if (core::config('general.faq')==1):?>
                    <?php echo Theme::nav_link(__('FAQ'),'faq','glyphicon glyphicon-question-sign','index','faq')?>
                <?php endif?>
                <?php if (core::config('general.forums')==1):?>
                    <?php echo Theme::nav_link(__('Forums'),'forum','glyphicon glyphicon-tag','index','forum-home')?>
                <?php endif?>
                <?php echo Theme::nav_link(__('Search'),'ad', 'glyphicon glyphicon-search ', 'advanced_search', 'search')?>
                <?php if (core::config('advertisement.map')==1):?>
                    <?php echo Theme::nav_link('','map', 'glyphicon glyphicon-globe ', 'index', 'map')?>
                <?php endif?>
                <?php echo Theme::nav_link(__('Contact'),'contact', 'glyphicon glyphicon-envelope ', 'index', 'contact')?>
                <?php echo Theme::nav_link('','rss', 'glyphicon glyphicon-signal ', 'index', 'rss')?>
            </ul>
        <?php endif?>
            
        </div>

        
        <!--/.nav-collapse --> 
    </div>
    <!-- end container--> 
</div>

<div id="logo">
    <div class="container">
    <div class="row">
        <div class="col-lg-8">
            <a class="brand" href="<?php echo Route::url('default')?>" title="<?php echo HTML::chars(core::config('general.site_name'))?>">

                <?php if (Theme::get('logo_url')!=''):?>
                    <img src="<?php echo Theme::get('logo_url')?>" alt="<?php echo HTML::chars(core::config('general.site_name'))?>" >
                <?php else:?>
                    <h1><?php echo core::config('general.site_name')?></h1>
                <?php endif?>
            </a>
        </div>
        <?php if (Theme::get('short_description')!=''):?>
        <div class="col-lg-8">
            <p class="lead"><?php echo Theme::get('short_description')?></p>
        </div>
        <?php endif?>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-30 pull-right">
            <?php echo  FORM::open(Route::url('search'), array('class'=>'navbar-form '.(Theme::get('short_description')!='')?'no-margin':'', 
                'method'=>'GET', 'action'=>''))?>
                <input type="text" name="search" class="form-control col-lg-3 col-md-3 col-sm-12 col-xs-12" placeholder="<?php echo __('Search')?>">
            <?php echo  FORM::close()?>
        </div>
        </div>
    </div>
</div>

<!-- end navbar top-->
<div class="subnav navbar <?php echo ((Request::current()->controller()!=='faq') AND Theme::get('fixed_toolbar')==1)?'':'fixed_header'?>">
  <div class="container">

    <ul class="nav nav-pills">
        <?php
            $cats = Model_Category::get_category_count();

            $cat_id = NULL;
            $cat_parent = NULL;

            if (Model_Category::current()->loaded())
            {
                $cat_id = Model_Category::current()->id_category;
                $cat_parent =  Model_Category::current()->id_category_parent;
            }
        ?>
        <?php foreach($cats as $c ):?>
            <?php if($c['id_category_parent'] == 1 && $c['has_siblings'] == FALSE):?>
                <li  class="<?php echo ($c['id_category'] == $cat_id)?'active':''?>"> 
                    <a title="<?php echo HTML::chars($c['name'])?>" href="<?php echo Route::url('list', array('category'=>$c['seoname']))?>">
                        <?php echo $c['name']?> </a>
                </li>
            <?php elseif($c['id_category_parent'] == 1 && $c['id_category'] != 1):?>
                <li class="dropdown <?php echo ($c['id_category'] == $cat_parent OR $c['id_category'] == $cat_id)?'active':''?>">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="<?php echo HTML::chars($c['name'])?>" >
                        <?php echo $c['name']?><b class="caret"></b></a>

                    <ul class="dropdown-menu">                          
                    <?php foreach($cats as $chi):?>
                    <?php if($chi['id_category_parent'] == $c['id_category']):?>
                        <li class="<?php echo ($chi['id_category'] == $cat_id)?'active':''?>" >
                            <a title="<?php echo HTML::chars($chi['name'])?>" href="<?php echo Route::url('list', array('category'=>$chi['seoname']))?>">
                            <?php echo $chi['name']?> <span class="badge pull-right"><?php echo $chi['count']?></span></a>
                        </li>
                    <?php endif?>
                    <?php endforeach?>
                    <li class="divider"></li>
                    <li><a title="<?php echo HTML::chars($c['name'])?>" href="<?php echo Route::url('list', array('category'=>$c['seoname']))?>">
                        <?php echo $c['name']?> <span class="badge badge-success pull-right"><?php echo $c['count']?></span></a></li>
                    </ul>
                    
                </li>
            <?php endif?>
        <?php endforeach?>
    </ul>
    <!-- end nav-pills--> 
    <div class="clear"></div>
   </div> <!-- end container-->
  </div><!-- end .subnav-->


<?php if (!Auth::instance()->logged_in()):?>
    <div id="login-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <a class="close" data-dismiss="modal" >&times;</a>
                  <h3><?php echo __('Login')?></h3>
                </div>
                
                <div class="modal-body">
                    <?php echo View::factory('pages/auth/login-form')?>
                </div>
            </div>
        </div>
    </div>
    
    <div id="forgot-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <a class="close" data-dismiss="modal" >&times;</a>
                  <h3><?php echo __('Forgot password')?></h3>
                </div>
                
                <div class="modal-body">
                    <?php echo View::factory('pages/auth/forgot-form')?>
                </div>
            </div>
        </div>
    </div>
    
     <div id="register-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <a class="close" data-dismiss="modal" >&times;</a>
                  <h3><?php echo __('Register')?></h3>
                </div>
                
                <div class="modal-body">
                    <?php echo View::factory('pages/auth/register-form', ['recaptcha_placeholder' => 'recaptcha4'])?>
                </div>
            </div>
        </div>
    </div>
<?php endif?>