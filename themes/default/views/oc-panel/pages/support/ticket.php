<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
    <h1><?php echo $ticket->title?></h1>
    <p><?php echo $ticket->user->name?> <?php echo Date::fuzzy_span(Date::mysql2unix($ticket->created))?> - <?php echo $ticket->product->title?></p>

    <a class="btn btn-default pull-right" id="collapse-all-tickets"><?php echo __('Collapse')?> <i class="glyphicon glyphicon-chevron-down"></i></a>

    <?php if($ticket->status!=Model_Ticket::STATUS_CLOSED):?>
    <a class="btn btn-warning pull-right" href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'close','id'=>$ticket->id_ticket))?>">
    <?php echo __('Close Ticket')?></a>
    <?php endif?> 

    <?php if(Auth::instance()->get_user()->has_access('supportadmin')):?>

        <form class="form-inline pull-right" method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'ticket','id'=>$ticket->id_ticket))?>"> 
            <?php echo  FORM::select('agent', $users, $ticket->id_user_support, array( 
                'id' => 'agent', 
                'data-trigger'=>"hover",
                'data-placement'=>"right",
                'data-toggle'=>"popover",
                'class'=>'form-control',
                ))?> 
            <button type="submit" class="btn btn-info"><?php echo __('Assign')?></button>
        </form>

        <a target="_blank" href="<?php echo Route::url('oc-panel', array('controller'=> 'order', 'action'=>'update','id'=>$ticket->order->pk())) ?>">
            <?php echo round($ticket->order->amount,2)?><?php echo $ticket->order->currency?> <?php echo Date::format($ticket->order->pay_date,'d-m-y')?>
        </a>

        <br>
        <a target="_blank" href="<?php echo Route::url('oc-panel', array('controller'=> 'user', 'action'=>'update','id'=>$ticket->id_user)) ?>">
            <?php echo $ticket->user->email?>
        </a>
        - <a target="_blank" href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'index','id'=>'admin'))?>?search=<?php echo $ticket->user->email?>">
            <?php echo __('Tickets')?></a>
        - <a target="_blank" href="<?php echo Route::url('oc-panel',array('controller'=>'order','action'=>'index'))?>?filter__id_user=<?php echo $ticket->user->email?>">
            <?php echo __('Orders')?></a>


        <?php if ($ticket->order->licenses->count_all()>0):?>
        <?php foreach ($ticket->order->licenses->find_all() as $license):?>
            <br>
            <a target="_blank" href="http://<?php echo $license->domain?>" target="_blank">
                <?php echo $license->domain?>
            </a>
            -
            <a target="_blank" href="<?php echo Route::url('oc-panel', array('controller'=> 'license', 'action'=>'update','id'=>$license->id_license)) ?>">
                <?php echo (empty($license->domain))?__('Inactive license'):__('Active license')?>
            </a>
        <?php endforeach?>
        <?php endif?>
    <?php endif?> 

     <div class="clearfix"></div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12 user-ticket">
                <div class="dropdown-user invisible pull-right btn btn-primary btn-xs" data-for=".<?php echo HTML::chars($ticket->user->name)?>">
                    <i class="glyphicon glyphicon-chevron-down"></i>
                </div>
                <div class="<?php echo HTML::chars($ticket->user->name)?> short-text">
                    <div class="col-md-2 pull-left">
                        <div class="pull-left">
                            <span class="text-muted"><?php echo $ticket->user->name?></span><br>
                            <span class="text-muted"><?php echo $ticket->created?></span>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9 ">
                        <p><?php echo Text::limit_chars(Text::bb2html($ticket->description,TRUE), 100, NULL, TRUE)?></p>
                    </div>
                </div>
                <div class="<?php echo HTML::chars($ticket->user->name)?> user-infos long-text">
                    <div class="col-md-2 pull-left">
                        <img class="ticket_image img-circle" src="<?php echo $ticket->user->get_profile_image()?>" style="max-width:120px; max-height:120px;">
                        <div class="pull-left">
                            <span class="text-muted"><?php echo $ticket->user->name?></span><br>
                            <span class="text-muted"><?php echo Date::fuzzy_span(Date::mysql2unix($ticket->created))?></span><br>
                            <span class="text-muted"><?php echo $ticket->created?></span>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9 ">
                        <p><?php echo Text::bb2html($ticket->description,TRUE)?></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div><hr>
            
            <?php foreach ($replies as $reply):?>
            <div class="col-md-12 user-ticket">
                <div class="dropdown-user invisible pull-right btn btn-primary btn-xs" data-for=".<?php echo HTML::chars($reply->user->name).'_'.$reply->id_ticket?>">
                    <i class="glyphicon glyphicon-chevron-down"></i>
                </div>
                <div class="<?php echo HTML::chars($reply->user->name).'_'.$reply->id_ticket?> short-text">
                    <div class="col-md-2 pull-left">
                        <div class="pull-left">
                            <span class="text-muted"><?php echo $reply->user->name?></span><br>
                            <span class="text-muted"><?php echo $reply->created?></span>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9 ">
                        <p><?php echo Text::limit_chars(Text::removebbcode($reply->description,TRUE), 100, NULL, TRUE)?></p>
                    </div>
                </div>
                <div class="<?php echo HTML::chars($reply->user->name).'_'.$reply->id_ticket?> user-infos long-text " >
                    <div class="col-md-2">
                        <img class="ticket_image img-circle" src="<?php echo $reply->user->get_profile_image()?>" style="max-width:120px; max-height:120px;">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0">
                            <span class="text-muted"><?php echo $reply->user->name?></span><br>
                            <span class="text-muted"><?php echo Date::fuzzy_span(Date::mysql2unix($reply->created))?></span><br>
                            <span class="text-muted"><?php echo $reply->created?></span><br>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <p><?php echo Text::bb2html($reply->description,TRUE)?></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div><hr>
            <?php endforeach?>
            
            <?php if($ticket->status!=Model_Ticket::STATUS_CLOSED OR Auth::instance()->get_user()->has_access('supportadmin')):?>
            
                <?php if($ticket->status==Model_Ticket::STATUS_CLOSED):?>
                    <div class="alert alert-warning" role="alert">
                    <?php echo __('This ticket is closed, by replying you will reopen the ticket.')?>
                    </div>
                <?php endif?>
            
                <form class="well form-horizontal"  method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'ticket','id'=>$ticket->id_ticket))?>">         
            
                  <?php if ($errors): ?>
                    <p class="message"><?php echo __('Some errors were encountered, please check the details you entered.')?></p>
                    <ul class="errors">
                    <?php foreach ($errors as $message): ?>
                        <li><?php echo $message ?></li>
                    <?php endforeach ?>
                    </ul>
                    <?php endif ?>       
            
            
                  <div class="form-group">
                    <label class="col-md-2"><?php echo __("Reply")?>:</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea id="description" name="description" rows="10" class="form-control" required><?php echo core::post('description')?></textarea>
                    </div>
                  </div>
            
                  <?php echo Form::token('reply_ticket')?>
                  <div class="form-actions">
                    <a href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'index'))?>" class="btn btn-default"><?php echo __('Cancel')?></a>
                    <button type="submit" class="btn btn-primary"><?php echo __('Reply')?></button>
                  </div>
                </form>  
            
            <?php endif?>  
            
            <br><br>
        </div>
    </div>
</div>