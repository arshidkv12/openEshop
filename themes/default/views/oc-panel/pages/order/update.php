<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="page-header">
    <h1><?php echo __('Update')?> <?php echo ucfirst(__($name))?></h1>
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

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Order Licenses')?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <th><?php echo __('License')?></th>
            <th><?php echo __('Created')?></th>
            <th><?php echo __('Domain')?></th>
            <th></th>
            <?php foreach ($licenses as $license):?>
                <tr>
                    <td><?php echo $license->license?></td>
                    <td><?php echo $license->created?></td>
                    <td><?php echo ($license->status==Model_License::STATUS_NOACTIVE)?__('Inactive'):$license->domain?></td>
                    <td><a title="<?php echo __('Edit')?>" class="btn btn-primary" href="<?php echo Route::url('oc-panel', array('controller'=> 'license', 'action'=>'update','id'=>$license->pk()))?>">
                        <i class="glyphicon glyphicon-edit"></i></a></td>
                <tr>
            <?php endforeach?>    
        </table>
    </div>
</div>