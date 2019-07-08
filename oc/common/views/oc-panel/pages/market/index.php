<?php defined('SYSPATH') or die('No direct script access.');?>


<h1 class="page-header page-title"><?php echo __('Market')?></h1>
<hr>
    <p><?php echo __('Selection of nice extras for your installation.')?></p>


<div class="row">
    <?php echo View::factory('oc-panel/pages/market/listing',array('market'=>$market))?>
</div>