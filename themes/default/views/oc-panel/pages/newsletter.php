<?php defined('SYSPATH') or die('No direct script access.');?>

<?php echo View::factory('oc-panel/elasticemail')?>

<?php if (Theme::get('premium')!=1):?>
    <p class="well"><span class="label label-info"><?php echo __('Heads Up!')?></span> 
        <?php echo __('Only if you have a premium theme you will be able to filter by users!').'<br/>'.__('Upgrade your Open eShop site to activate this feature.')?>
        <a class="btn btn-success pull-right" href="<?php echo Route::url('oc-panel',array('controller'=>'theme'))?>"><?php echo __('Browse Themes')?></a>
    </p>
<?php endif?>

<div class="page-header">
    <a class="btn btn-primary pull-right" href="<?php echo Route::url('oc-panel',array('controller'=>'settings','action'=>'email'))?>?force=1">
        <?php echo __('Email Settings')?>
    </a>
	<h1><?php echo __('Newsletter')?></h1>
    <a href="http://open-classifieds.com/2013/08/23/how-to-send-the-newsletter/" target="_blank"><?php echo __('Read more')?></a>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal"  method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'newsletter','action'=>'index'))?>">  
            
                <?php echo Form::errors()?> 
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo __('To')?>:</label>
                    <div class="col-md-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="send_all" checked >
                                <?php echo __('All active users.')?> <span class="badge badge-info"><?php echo $count_all_users?></span>
                            </label>
                        </div> 
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="send_expired_support"  >
                                <?php echo __('Expired support.')?> <span class="badge badge-info"><?php echo $count_support_expired?></span>
                            </label>
                        </div> 
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="send_expired_license"  >
                                <?php echo __('Expired license.')?> <span class="badge badge-info"><?php echo $count_license_expired?></span>
                            </label>
                        </div> 
                        <select name="send_product" class="form-control">
                            <option><?php echo __('Users who bought the product')?></option>
                            <?php foreach ($products as $p):?>
                                <option value="<?php echo $p['id_product']?>" <?php echo (core::request('send_product')==$p['id_product'])?'selected':''?>>
                                    <?php echo $p['title']?> (<?php echo $p['count']?>)
                                </option>
                            <?php endforeach?>
                        </select>
                    </div> 
                </div>
               
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo __('From')?>:</label>
                    <div class="col-md-10">
                        <input type="text" name="from" value="<?php echo Auth::instance()->get_user()->name?>" class="col-md-6 form-control">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo __('From Email')?>:</label>
                    <div class="col-md-10">
                        <input  type="text" name="from_email" value="<?php echo Auth::instance()->get_user()->email?>" class="col-md-6 form-control">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo __('Subject')?>:</label>
                    <div class="col-md-10">
                        <input  type="text" name="subject" value="" class="col-md-6 form-control">
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo __('Message')?>:</label>
                    <div class="col-md-10">
                        <textarea  name="description"  id="formorm_description" class="col-md-10 col-sm-10 col-xs-12 form-control" data-editor="html" rows="15" ></textarea>
                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <a href="<?php echo Route::url('oc-panel')?>" class="btn btn-default"><?php echo __('Cancel')?></a>
                        <button type="submit" class="btn btn-primary"><?php echo __('Send')?></button>
                    </div>
                </div>
        </form>
    </div>
</div>    