<?php defined('SYSPATH') or die('No direct script access.');?>
<hr>

<footer>
<!--This is the license for Open eShop, do not remove -->
<p>&copy;
<?php if (Theme::get('premium')!=1):?>
    Powered by <a href="http://open-eshop.com?utm_source=<?php echo URL::base()?>&utm_medium=oc_footer&utm_campaign=<?php echo date('Y-m-d')?>" title="Best PHP Script to sell digital goods Software">Open eShop</a> 
<?php else:?>
    <?php echo core::config('general.site_name')?> <?php echo date('Y')?>
<?php endif?>    

</p>
</footer>

<div class="modal fade" id="docModal" tabindex="-1" role="dialog" aria-labelledby="docModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>