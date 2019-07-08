<?php defined('SYSPATH') or die('No direct script access.');?>
<li title="<?php echo HTML::chars($route)?>" class="<?php echo (strtolower(Request::current()->controller())==$controller AND Request::current()->action()==$action)?'active':''?> <?php echo $style?>" >
    <a  href="<?php echo Route::url($route,array('controller'=>$controller,'action'=>$action,'id'=>$id))?>">
        <?php if($icon!==NULL):?>
            <i class="<?php echo $icon?>"></i>
        <?php endif?>
        <?php echo $name?>
    </a>
</li>