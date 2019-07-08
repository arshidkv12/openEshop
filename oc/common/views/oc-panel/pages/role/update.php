<?php defined('SYSPATH') or die('No direct script access.');?>
<h1 class="page-header page-title"><?php echo __('Update')?> <?php echo Text::ucfirst($role->name)?></h1>
<hr>
<form action="<?php echo Route::url('oc-panel',array('controller'=>'role','action'=>'update','id'=>$role->id_role))?>" method="post" accept-charset="utf-8" class="form form-horizontal" >  

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <input type="hidden" name="id_role" value="<?php echo $role->id_role?>" />
                    <div class="form-group ">
                        <label for="name" class="col-md-3 control-label"><?php echo __('Name')?></label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="text" id="name" name="name" value="<?php echo $role->name?>" maxlength="45" />
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="description" class="col-md-3 control-label"><?php echo __('Description')?></label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="text" name="description" maxlength="245" value="<?php echo $role->description?>" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-offset-3 col-md-5 col-sm-5 col-xs-12">
                            <button type="submit" name="submit" class="btn btn-primary"><?php echo __('Update')?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $i=0; foreach ($controllers as $controller=>$actions):?>
            <?php if ($i%3==0):?></div><div class="row"><?php endif?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>
                                <div class="checkbox check-success">
                                    <?php echo FORM::checkbox($controller.'|*', 'on', (bool) in_array($controller.'.*',$access_in_use), ['id' => $controller.'|*'])?>
                                    <label for="<?php echo $controller.'|*'?>"><?php echo $controller?>.*</label>
                                </div>
                            </h4>
                            <p>
                                <?php foreach ($actions as $action):?>
                                <div class="checkbox check-success">
                                    <?php echo FORM::checkbox($controller.'|'.$action, 'on', (bool) in_array($controller.'.'.$action,$access_in_use), ['id' => $controller.'|'.$action])?>
                                    <label for="<?php echo $controller.'|'.$action?>"><?php echo $action?></label>
                                </div>
                                <?php endforeach?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php $i++;
        endforeach?>
    </div><!--/row-->

    <div class="form-actions">
        <button type="submit" name="submit" class="btn btn-primary"><?php echo __('Update')?></button>
    </div>

</form>