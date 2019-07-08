<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header" id="crud-<?php echo __($name)?>">
    <h1><?php echo __('New')?> <?php echo ucfirst(__($name))?></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $form->render()?>
            </div>
        </div>
    </div>
</div>