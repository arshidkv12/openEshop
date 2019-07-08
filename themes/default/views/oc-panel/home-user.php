<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="hero-unit">
    <h1>
    <?php echo __('Welcome')?>
    <?php echo Auth::instance()->get_user()->name?>
        &nbsp; <small><?php echo Auth::instance()->get_user()->email?> </small>
    </h1>

    <p><?php echo __('Thanks for using our website.')?> </a>
</div>