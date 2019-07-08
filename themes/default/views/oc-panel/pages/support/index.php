<?php defined('SYSPATH') or die('No direct script access.');?>

<form class="form-inline" method="get" action="<?php echo URL::current();?>">
    <div class="form-group pull-right">
        <div class="">
            <input type="text" class="form-control search-query" name="search" placeholder="<?php echo __('search')?>" value="<?php echo core::get('search')?>">
        </div>
    </div>
</form>

<div class="page-header">
	<h1><?php echo $title?></h1>
    <p><a target="_blank" href="https://docs.open-eshop.com/support/" target="_blank"><?php echo __('Read more')?></a></p>
    <br>
    <div class="btn-group">
        <a href="?status=-1" class="btn <?php echo (core::get('status',-1)==-1)?'btn-primary':'btn-default'?>">
            <?php echo __('All')?>
        </a>
        <?php foreach (Model_Ticket::$statuses as $k => $v):?>
        <a href="?status=<?php echo $k?>" class="btn <?php echo (core::get('status',-1)==$k)?'btn-primary':'btn-default'?>">
            <?php echo $v?>
        </a>
        <?php endforeach?>

        <?php if(Auth::instance()->get_user()->has_access('supportadmin') AND core::get('status')==Model_Ticket::STATUS_HOLD):?>
        <a
            href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'massclose'))?>" 
            class="btn btn-warning" 
            title="<?php echo __('Close holded tickets without answer in 1 month?')?>" 
            data-toggle="confirmation" 
            data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
            data-btnCancelLabel="<?php echo __('No way!')?>">
            <?php echo __('Close Old Tickets')?>
        </a>
        <?php endif?>
    </div>

    <a class="btn btn-info pull-right" href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'new'))?>">
        <i class="glyphicon glyphicon-envelope"></i> <?php echo __('New Ticket')?></a>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                     <tr>
                        <th><?php echo __('Title')?></th>
                        <th><?php echo __('Date')?></th>
                        <th><?php echo __('Last Answer')?></th>
                        <th><?php echo __('Agent')?></th>
                        <th ></th>
                    </tr>
                </thead>
        
                <tbody>
                    <?php foreach ($tickets as $ticket):?>
                    <tr class="<?php echo ($ticket->status==Model_Ticket::STATUS_CLOSED)?'danger':''?>
                        <?php echo ($ticket->status==Model_Ticket::STATUS_HOLD)?'warning':''?>
                        <?php echo ($ticket->status==Model_Ticket::STATUS_READ)?'success':''?>">
                        <td><span class="ww"><?php echo ($ticket->title!='')?$ticket->title:Text::limit_chars(Text::removebbcode($ticket->description), 45, NULL, TRUE);?></span></td>
                        <td><?php echo $ticket->created?></td>
                        <td><?php echo (empty($ticket->read_date))?__('None'):$ticket->read_date?></td>
                        <td><?php echo (!$ticket->agent->loaded())?__('None'):$ticket->agent->name?></td>
                        <td><span class="label <?php echo ($ticket->status==Model_Ticket::STATUS_CLOSED)?'label-danger':''?>
                                                <?php echo ($ticket->status==Model_Ticket::STATUS_CREATED)?'label-info':''?>
                                                <?php echo ($ticket->status==Model_Ticket::STATUS_READ)?'label-success':''?>
                                                <?php echo ($ticket->status==Model_Ticket::STATUS_HOLD)?'label-warning':''?>">
                            <?php echo (Model_Ticket::$statuses[$ticket->status])?></span>
                        </td>
                        <td>
                            <a href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'ticket','id'=>($ticket->id_ticket_parent!=NULL)?$ticket->id_ticket_parent:$ticket->id_ticket))?>" class="btn btn-success">
                                <i class="glyphicon glyphicon-envelope"></i></a>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
        
            </table>
        </div>
    </div>
</div>

<div class="text-center"><?php echo $pagination?></div>