<button data-toggle="modal" data-target="#authorize_modal" class="btn btn-success pay-btn full-w">
    <?php echo __('Pay with Credit Card')?>
</button>

<!-- Modal -->
<div class="modal fade" id="authorize_modal" tabindex="-1" role="dialog" aria-labelledby="authorize_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo __('Pay with Credit Card')?></h4>
      </div>
      <div class="modal-body">
        

        <form class="form-horizontal authorize_form" method="post" role="form" action="<?php echo Route::url('default', array('controller'=> 'authorize','action'=>'pay' , 'id' => $order->id_order))?>">
            <fieldset>
                <legend><?php echo __('Pay with Credit Card')?></legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="card-number"><?php echo __('Card Number')?></label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" name="card-number" id="card-number" placeholder="<?php echo __('Card Number')?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="expiry-month"><?php echo __('Expiration Date')?></label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-xs-4">
                                <select class="form-control" name="expiry-month" id="expiry-month" required="required">
                                    <?php foreach (Date::months(Date::MONTHS_SHORT) as $month=>$name):?>
                                    <option value="<?php echo $month?>" ><?php echo $month?> - <?php echo $name?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control" name="expiry-year" id="expiry-year" required="required">
                                    <?php foreach (range(date('y'),date('y')+10) as $year):?>
                                    <option><?php echo $year?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>         
            </fieldset>

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel')?></button>
        <button type="submit" class="btn btn-success btn-lg pull-right"><?php echo __('Pay With Card')?> <span class="glyphicon glyphicon-chevron-right"></span></button>
         </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->