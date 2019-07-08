<?php defined('SYSPATH') or die('No direct script access.');?>
<h1 class="page-header page-title" id="crud-<?php echo $name?>"><?php echo __('Update')?> <?php echo Text::ucfirst(__($name))?></h1>
<hr>
  <p>
    <?php $controllers = Model_Access::list_controllers()?>
    <a target="_blank" href="<?php echo Route::url('oc-panel',array('controller'=>'order','action'=>'index'))?>?email=<?php echo $form->object->email?>">
      <?php echo __('Orders')?>
    </a>
    <?php if (array_key_exists('ticket', $controllers)) :?>
      - <a target="_blank" href="<?php echo Route::url('oc-panel',array('controller'=>'support','action'=>'index','id'=>'admin'))?>?search=<?php echo $form->object->email?>">
          <?php echo __('Tickets')?></a>
      </a>
    <?php endif?>
    <?php if (array_key_exists('ad', $controllers)) :?>
      - <a target="_blank" href="<?php echo Route::url('profile',array('seoname'=>$form->object->seoname))?>">
          <?php echo __('Ads')?>
      </a>
    <?php endif?>
    <?php if (core::config('advertisement.reviews')==1 OR core::config('product.reviews')==1):?>
      - <a target="_blank" href="<?php echo Route::url('oc-panel',array('controller'=>'review','action'=>'index'))?>?email=<?php echo $form->object->email?>">
          <?php echo __('Reviews')?>
      </a>
    <?php endif?>
  </p>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $form->render()?>
            </div>
        </div>
        <?php if (Auth::instance()->get_user()->is_admin()):?>
          <div class="panel panel-default">
              <div class="panel-heading" id="page-edit-profile">
                  <h3 class="panel-title"><?php echo __('Change password')?></h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-8">
                          <form class="form-horizontal"  method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'user','action'=>'changepass','id'=>$form->object->id_user))?>">         
                              <?php echo Form::errors()?>  
                                    
                              <div class="form-group">
                                  <label class="col-xs-4 control-label"><?php echo __('New password')?></label>
                                  <div class="col-sm-8">
                                  <input class="form-control" type="password" name="password1" placeholder="<?php echo __('Password')?>">
                                  </div>
                              </div>
                                
                              <div class="form-group">
                                  <label class="col-xs-4 control-label"><?php echo __('Repeat password')?></label>
                                  <div class="col-sm-8">
                                  <input class="form-control" type="password" name="password2" placeholder="<?php echo __('Password')?>">
                                      <p class="help-block">
                                            <?php echo __('Type your password twice to change')?>
                                      </p>
                                  </div>
                              </div>
                                    
                              <div class="form-group">
                                  <div class="col-md-offset-4 col-md-8">
                                      <button type="submit" class="btn btn-primary"><?php echo __('Update')?></button>
                                  </div>
                              </div>
                                    
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        <?php endif?>
    </div>
</div>
