<?php defined('SYSPATH') or die('No direct script access.');?>
<li <?php echo (strtolower(Request::current()->controller())==$controller)?'class="active"':''?>>
    <a href="<?php echo Route::url($route,array('controller'=>$controller,'action'=>$action,'id'=>$id))?>" 
    	title="<?php echo HTML::chars($name)?>" 
    	class="<?php echo ($ajax)?'ajax-load':NULL?>">
        <?php if($icon!==NULL):?>
            <i class="<?php echo $icon?>"></i>
        <?php endif?>
        <span class="side-name-link"><?php echo $name?></span>
    </a>
</li>