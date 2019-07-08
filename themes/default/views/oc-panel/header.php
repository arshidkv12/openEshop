<?php defined('SYSPATH') or die('No direct script access.');?>
<header class="navbar navbar-default navbar-fixed-top bs-docs-nav">
    <div class="header-container">
        <div class="navbar-header">        </div> 

            <button class="navbar-toggle pull-left" type="button" data-toggle="collapse" id="mobile_header_btn">
                <span class="sr-only"><?php echo __('Toggle navigation')?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand ajax-load" href="<?php echo (Auth::instance()->get_user()->id_role!=Model_Role::ROLE_ADMIN) ? Route::url('oc-panel',array('controller'=>'profile','action'=>'index')) : Route::url('oc-panel',array('controller'=>'home'))?>">
                <i class="glyphicon glyphicon-th-large"></i> <?php echo __('Panel')?>
            </a>
            <div class="btn-group pull-right ml-20">
                <?php echo View::factory('oc-panel/widget_login')?>
            </div>

            <div class="navbar-collapse collapse" id="mobile-menu-panel">
                <ul class="nav navbar-nav">

                    <?php if (Theme::get('premium')!=1):?>
                        <?php echo Theme::admin_link(__('Market'), 'market','index','oc-panel','glyphicon glyphicon-gift')?>
                    <?php endif?>

                    <?php if (!Auth::instance()->get_user()->has_access_to_any('supportadmin')):?>
                        <?php echo Theme::admin_link(__('Support'), 'support','index','oc-panel','glyphicon glyphicon-comment')?>
                    <?php else:?>
                        <?php echo Theme::admin_link(__('Support Admin'), 'support','index','oc-panel','glyphicon glyphicon-comment','admin')?>
                        <?php echo Theme::admin_link(__('Support Assigned'), 'support','index','oc-panel','glyphicon glyphicon-comment','assigned')?>
                    <?php endif?>

                	<?php echo Theme::admin_link(__('Stats'),'stats','index','oc-panel','glyphicon glyphicon-align-left')?>
                    <?php echo Theme::admin_link(__('Widgets'),'widget','index','oc-panel','glyphicon glyphicon-move')?>

                    <?php if (Auth::instance()->get_user()->has_access_to_any('tools')):?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-cog"></i> <?php echo __('Cache')?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <?php echo Theme::admin_link(__('Cache'),'tools','cache','oc-panel','glyphicon glyphicon-cog')?>
                            <li>
                                <a class="ajax-load" title="<?php echo __('Delete all')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'cache')).'?force=1'?>">
                                    <i class="glyphicon glyphicon-remove-sign"></i> <span class="side-name-link"><?php echo __('Delete all')?></span>
                                </a>
                            </li>
                            <li>
                                <a class="ajax-load" title="<?php echo __('Delete expired')?>" href="<?php echo Route::url('oc-panel',array('controller'=>'tools','action'=>'cache')).'?force=2'?>">
                                    <i class="glyphicon glyphicon-remove-circle"></i> <span class="side-name-link"><?php echo __('Delete expired')?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif?>

                    <?php if(Auth::instance()->get_user()->id_role==Model_Role::ROLE_ADMIN):?>
            	    <li  class="dropdown "><a href="#" class="dropdown-toggle"
            		      data-toggle="dropdown"><i class="glyphicon glyphicon-plus"></i> <?php echo __('New')?> <b class="caret"></b></a>
                    	<ul class="dropdown-menu">
                            <?php echo Theme::admin_link(__('Product'),'product','create')?>
                            <?php echo Theme::admin_link(__('Blog post'),'blog','create')?>
                            <?php echo Theme::admin_link(__('FAQ'),'content','create?type=help&locale_select='.core::config('i18n.locale'),'oc-panel')?>
                            <?php echo Theme::admin_link(__('Page'), 'content','create?type=page&locale_select='.core::config('i18n.locale'),'oc-panel')?>
                    	</ul>
            	   </li> 
                   <?php endif?>

                </ul>
                
                <div class=""></div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo Route::url('default')?>">
                                <i class="  glyphicon-home glyphicon"></i>
                            <?php echo _('Visit Site')?>
                        </a>
                    </li>
                </ul>

            </div> <!--/.nav-collapse -->

    </div><!-- /.header-container -->

</header><!--/.navbar -->
