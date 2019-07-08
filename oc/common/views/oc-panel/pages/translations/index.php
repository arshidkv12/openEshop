<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="btn-group pull-right">
    <div class="btn-group dropdown">
        <?php if (class_exists('IntlCalendar')) :?>
        <button class="btn btn-primary" data-toggle="dropdown" type="button"><?php echo __('New translation')?></button>
        <div class="dropdown-menu dropdown-menu-right">
            <form class="col-sm-12" role="form" method="post" action="<?php echo Request::current()->url()?>">
                <div class="form-group">
                    <label class="sr-only" for="locale"><?php echo __('New translation')?></label>
                    <select class="form-control" id="locale" name="locale">
                        <?php foreach (IntlCalendar::getAvailableLocales() as $locale):?>
                            <option value="<?php echo $locale?>"><?php echo $locale?></option>
                        <?php endforeach?>
                    </select>
                    <p class="help-block"><?php echo __('If your locale is not listed, be sure your hosting has your locale installed.')?></p>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo __('Create')?></button>
            </form>
        </div>
        <?php endif?>
    </div>
    <a class="btn btn-info" href="<?php echo Route::url('oc-panel',array('controller'=>'translations','action'=>'index'))?>?parse=1" >
        <?php echo __('Scan')?>
    </a>
</div>

<h1 class="page-header page-title">
    <?php echo __('Translations')?> 
    <a target="_blank" href="http://docs.yclas.com/how-to-change-language/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>
<hr>

<p>
    <?php echo __('Translations files available in the system.')?>
</p>

<div class="panel panel-default">
    <table class="table" id="translations-table">
        <thead>
            <tr>
                <th><?php echo __('Language')?></th>
                <th style="width: 10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($languages as $language):?>
                <tr class="<?php echo ($language==$current_language)?'success':''?>">
                    <td><?php echo $language?></td>
                    <td class="nowrap">    
                        <ul class="list-inline">
                            <li>
                                <a class="btn btn-warning ajax-load" 
                                    href="<?php echo Route::url('oc-panel', array('controller'=>'translations','action'=>'edit','id'=>$language))?>" 
                                    rel"tooltip" title="<?php echo __('Edit')?>">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </li>
                            <li>
                                <?php if ($language!=$current_language):?>
                                    <a class="btn btn-default" 
                                        href="<?php echo Route::url('oc-panel', array('controller'=>'translations','action'=>'index','id'=>$language))?>" 
                                        rel"tooltip" title="<?php echo __('Activate')?>">
                                        <?php echo __('Activate')?>
                                    </a>
                                <?php else:?>
                                    <span class="label label-info"><?php echo __('Active')?></span>
                                <?php endif?>
                            </li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>