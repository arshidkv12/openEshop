<?php defined('SYSPATH') or die('No direct script access.');?>
<a class="btn btn-success navbar-btn"
	href="<?php echo Route::url('oc-panel',array('controller'=>'home','action'=>'index'))?>">
	<i class="glyphglyphicon glyphicon-user glyphicon"></i> 
</a>
<a class="btn dropdown-toggle btn-success navbar-btn"  data-toggle="dropdown"
	href="#"> <span class="caret"></span>
</a>

<ul class="dropdown-menu">
	
	<li><a href="<?php echo Route::url('oc-panel',array('controller'=>'home','action'=>'index'))?>">
        <i class="glyphicon glyphglyphicon glyphicon-cog"></i> <?php echo __('Panel')?></a></li>

    <li><a href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'orders'))?>"><i
           class="glyphicon glyphglyphicon glyphicon-shopping-cart"></i> <?php echo __('My Purchases')?></a></li>

    <li><a href="<?php echo Route::url('oc-panel',array('controller'=>'support'))?>"><i
               class="glyphicon glyphicon-comment"></i> <?php echo __('Support')?></a></li>

	<li><a href="<?php echo Route::url('oc-panel',array('controller'=>'profile','action'=>'edit'))?>"><i
		   class="glyphicon glyphglyphicon glyphicon-lock"></i> <?php echo __('Edit profile')?></a></li>

	<li class="divider"></li>
	<li><a
		href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'logout'))?>">
			<i class="glyphicon glyphglyphicon glyphicon-off"></i> <?php echo __('Logout')?>
	</a></li>
    <li>
        <a
        href="<?php echo Route::url('default')?>">
            <i class="glyphicon glyphglyphicon glyphicon-home"></i> <?php echo __('Visit Site')?></a>
	</li>
</ul>
