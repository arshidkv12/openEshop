<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="clear"></div>

<footer>
    <div class="container">
        <?php echo (Theme::get('footer_ad')!='')?Theme::get('footer_ad'):''?>
        <?php if(Core::config('appearance.theme_mobile')!=''):?>
        <hr>
        <nav class="pages">
            <ul>
                <li>
                    <a href="<?php echo Route::url('default')?>?theme=<?php echo Core::config('appearance.theme_mobile')?>"><?php echo __('Mobile Version')?></a>
                </li>
            </ul>
        </nav>
        <?php endif?>
        <!--This is the license for Open Classifieds, do not remove -->
        <p>&copy;
        <?php if (Theme::get('premium')!=1):?>
            Powered by <a href="http://open-eshop.com?utm_source=<?php echo URL::base()?>&utm_medium=oc_footer&utm_campaign=<?php echo date('Y-m-d')?>" title="Best PHP Script to sell digital goods Software">Open eShop</a> 
        <?php else:?>
            <?php echo core::config('general.site_name')?> <?php echo date('Y')?>
        <?php endif?>    
        </p>
    </div>
</footer>
