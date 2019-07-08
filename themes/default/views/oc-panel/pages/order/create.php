<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo Form::errors()?>

<div class="page-header">
    <h1><?php echo __('New Order')?></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'order','action'=>'create')), array('class'=>'form-horizontal product_form'))?>
                    <div class="form-group ">
                        <label for="formorm_paymethod" class="col-md-4 control-label"><?php echo __('Name')?></label> 
                        <div class="col-md-8">
                            <input type="text" id="formorm_paymethod" name="name" value="" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="formorm_paymethod" class="col-md-4 control-label"><?php echo __('Email')?></label>
                        <div class="col-md-8">
                            <input type="text" id="formorm_paymethod" name="email" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo  FORM::label('paymethod', __('Paymethod'), array('class'=>'col-md-4 control-label', 'for'=>'paymethod' ))?>
                        <div class="col-md-8">
                            <select name="paymethod" id="paymethod" class="form-control" REQUIRED>
                                <option>paypal</option>
                                <option>paymill</option>
                                <option>transfer</option>
                                <option>cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo  FORM::label('product', __('Product'), array('class'=>'col-md-4 control-label', 'for'=>'product' ))?>
                        <div class="col-md-8">
                            <select name="product" id="product" class="form-control" REQUIRED>
                                <option></option>
                                <?php foreach ($products as $p):?>
                                    <option value="<?php echo $p->id_product?>"><?php echo $p->title?> <?php echo $p->formated_price()?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo  FORM::label('currency', __('Currency'), array('class'=>'col-md-4 control-label', 'for'=>'currency' ))?>
                        <div class="col-md-8">
                            <select name="currency" id="currency" class="form-control" REQUIRED>
                                <option></option>
                                <?php foreach ($currency as $curr):?>
                                    <option <?php echo ($curr=='USD')?'selected':''?> value="<?php echo $curr?>"><?php echo $curr?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formorm_amount" class="col-md-4 control-label"><?php echo __('Amount')?></label>
                        <div class="col-md-8">
                            <input type="text" id="formorm_amount" name="amount" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formorm_pay_date" class="col-md-4 control-label"><?php echo __('Pay Date')?></label>
                        <div class="col-md-8">
                            <input type="text" id="formorm_pay_date" name="pay_date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d H:i:s')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formorm_notes" class="col-md-4 control-label"><?php echo __('Notes')?></label>
                        <div class="col-md-8">
                            <input type="text" id="formorm_notes" maxlength=245 name="notes" placeholder="Order notes 245 characters max" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-8">
                            <?php echo  FORM::button('submit', __('Save'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'order','action'=>'create'))))?>
                        </div>
                    </div>
                <?php echo  FORM::close()?>
            </div>
        </div>
    </div>
</div>
