<?php defined('SYSPATH') or die('No direct script access.');?>
<?php if (Auth::instance()->logged_in()):?>
<a class="btn btn-success"
	href="<?php echo Route::url('oc-panel',array('controller'=>'home','action'=>'index'))?>">
	<i class="glyphicon glyphicon-user "></i> 
</a>
<a class="btn dropdown-toggle btn-success" data-toggle="dropdown"
	href="#"> <span class="caret"></span>
</a>
<ul class="dropdown-menu">
	
	<li><a href="<?php echo Route::url('oc-panel',array('controller'=>'home','action'=>'index'))?>">
        <i class="glyphicon glyphicon-cog"></i> <?php echo __('Panel')?></a></li>


    <li><a href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'orders'))?>"><i
           class="glyphicon glyphicon-shopping-cart"></i> <?php echo __('My Purchases')?></a></li>
	
    <li><a href="<?php echo Route::url('oc-panel',array('controller'=>'support'))?>"><i
               class="glyphicon glyphicon-comment"></i> <?php echo __('Support')?></a></li>
               
	<li><a href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'edit'))?>"><i
		   class="glyphicon glyphicon-lock"></i> <?php echo __('Edit profile')?></a></li>

	<li class="divider"></li>
	<li><a
		href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'logout'))?>">
			<i class="glyphicon glyphicon-off"></i> <?php echo __('Logout')?>
	</a>
	</li>
    <li>
        <a
        href="<?php echo Route::url('default')?>">
            <i class="glyphicon glyphicon-home"></i> <?php echo __('Visit Site')?></a>
    </li>
</ul>
<?php else:?>
<a class="btn btn-primary-white" data-toggle="modal" 
	href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>#login-modal">
	<i class="glyphicon glyphicon-user"></i> <?php echo __('Login')?>
</a>
<?php endif?>