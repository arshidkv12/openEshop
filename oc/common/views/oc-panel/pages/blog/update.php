<?php defined('SYSPATH') or die('No direct script access.');?>
    <?php if($form['status']['value']==0):?>
        <a class="btn btn-primary pull-right" target="_blank" href="<?php echo Route::url('blog', array('seotitle'=>$form['seotitle']['value']))?>" title="<?php echo __('Preview')?>">
            <i class="glyphicon glyphicon-eye-open"></i> 
            <?php echo __('Preview')?>
        </a>
	<?php endif?>
<h1 class="page-header page-title" id="crud-<?php echo $name?>"><?php echo __('Edit Blog Post')?></h1>
<hr>
<?php //var_dump($form)?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'blog','action'=>'update')), array('enctype'=>'multipart/form-data'))?>
            <fieldset>
                <?php echo  FORM::hidden($form['id_post']['name'], $form['id_post']['value'])?>
                <?php echo  FORM::hidden($form['id_user']['name'], $form['id_user']['value'])?>
                <?php echo  FORM::hidden($form['seotitle']['name'], $form['seotitle']['value'])?>
                <div class="form-group">
                    <?php echo FORM::label($form['title']['id'], __('Title'), array('class'=>'control-label', 'for'=>$form['title']['id']))?>
                    <?php echo FORM::input($form['title']['name'], $form['title']['value'], array('placeholder' => __('Title'), 'class' => 'form-control', 'id' => $form['title']['id'], 'required'))?>
                </div>
                <div class="form-group">
                    <?php echo FORM::label($form['description']['id'], __('Description'), array('class'=>'control-label', 'for'=>$form['description']['id']))?>
                    <?php echo FORM::textarea($form['description']['name'], $form['description']['value'], array('class'=>'form-control','id' => $form['description']['id'],'data-editor'=>'html'))?>
                </div>
                <div class="form-group">
                    <div class="checkbox check-success">
                        <?php echo FORM::checkbox($form['status']['name'], 1, (bool) $form['status']['value'], ['id' => 'status'])?>
                        <label for="status"><?php echo __('Active')?></label>
                    </div>
                </div>
                <hr>
                <?php echo FORM::button('submit', __('Edit'), array('type'=>'submit', 'class'=>'btn btn-success', 'action'=>Route::url('oc-panel',array('controller'=>'blog','action'=>'update'))))?>
            </fieldset>
        <?php echo  FORM::close()?>
    </div>
</div>