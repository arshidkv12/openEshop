<h1 class="page-header page-title"><?php echo __('Translations')?> <?php echo $edit_language?></h1>
<hr>

<p>
<?php echo __('Here you can modify any text you find in your web.')?> <a href="https://docs.yclas.com/how-to-change-texts/" target="_blank"><?php echo __('Read more')?></a><br>
<?php echo sprintf("Total of %u strings. %u strings already translated", $total_items, $total_items-$cont_untranslated)?>. <span class="error"><?php echo sprintf("%u strings yet to translate",$cont_untranslated)?>.</span>
</p>

<form class="form-inline" method="get" action="<?php echo Route::url('oc-panel',array('controller'=>'translations','action'=>'edit','id'=>$edit_language))?>">
    <div class="form-group">
        <input type="text" class="form-control input-sm search-query" name="search" placeholder="<?php echo __('search')?>" value="<?php echo core::request('search')?>">
    </div>
    <button type="submit" class="btn btn-primary"><?php echo __('Search')?></button>
</form>

<form class="form-inline" method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'translations','action'=>'replace','id'=>$edit_language))?>">
        <div class="form-group">
            <input type="text" class="form-control input-sm search-query" name="search" placeholder="<?php echo __('search')?>" value="<?php echo core::request('search')?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control input-sm search-query" name="replace" placeholder="<?php echo __('replace')?>" value="<?php echo core::request('replace')?>">
        </div>
        <select name="where" id="where" class="form-control disable-chosen disable-select2" >
            <option value="original"><?php echo __('Replace Original')?></option>
            <option value="translation"><?php echo __('Replace Translation')?></option>
        </select>
    <button type="submit" class="btn btn-warning"><?php echo __('Replace')?></button>
</form>

<div class="panel panel-default">
    <div class="panel-body">
        <form enctype="multipart/form-data" class="form form-horizontal" accept-charset="utf-8" method="post" action="<?php echo str_replace('rel=ajax', '', URL::current())?>">
        
            <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th><?php echo __('Original Translation')?></th>
                <th><button class="btn" id="button-copy-all" 
                        data-text="<?php echo __('Copy all?, Be aware this will replace all your texts.')?>" >
                        <i class="glyphicon glyphicon-arrow-right"></i></button>
                    <?php if (strlen(Core::config('general.translate'))>0):?>
                        <button id="button-translate-all" class="btn" data-apikey="<?php echo Core::config('general.translate')?>"
                            data-text="<?php echo __('Translate all?, Be aware this will replace all your texts.')?>"
                            data-langsource="en" data-langtarget="<?php echo substr($edit_language,0,2)?>" ><i class="glyphicon glyphicon-globe"></i>
                        </button>
                    <?php endif?>
                </th>
                <th><?php echo __('Translation')?> <?php echo $edit_language?></th>
            </tr>

            <button type="submit" class="btn btn-primary pull-right" name="translation[submit]"><i class="glyphicon glyphicon-hdd"></i> <?php echo __('Save')?></button>

            <a  class="btn btn-danger pull-right" href="<?php echo Request::current()->url()?>?translated=1" title="<?php echo __('Hide translated texts')?>" >
                <i class="glyphicon glyphicon-eye-close"></i> 
            </a>
            
            <a  class="btn btn-primary pull-right" href="<?php echo Request::current()->url()?>" title="<?php echo __('Show translated texts')?>">
                <i class="glyphicon glyphicon-eye-open"></i> 
            </a>
        
            <?php foreach($translation_array as $key => $values):?>
                <?php list($id,$original,$translated) = array_values($values);?>
                <tr id="tr_<?php echo $id?>" class="<?php echo (strlen($translated)>0)? 'success': 'error'?>">
                    <td width="5%"><?php echo $id?></td>
                    <td>
                        <textarea id="orig_<?php echo $id?>" disabled style="width: 100%"><?php echo $original?></textarea>
                    </td>
                    <td width="5%">
                        <button class="btn button-copy" data-orig="orig_<?php echo $id?>" data-dest="dest_<?php echo $id?>" data-tr="tr_<?php echo $id?>" ><i class="glyphicon glyphicon-arrow-right"></i></button>
                        <br>
                        <?php if (strlen(Core::config('general.translate'))>0):?>
                            <button class="btn button-translate" data-orig="orig_<?php echo $id?>" data-dest="dest_<?php echo $id?>" data-tr="tr_<?php echo $id?>" ><i class="glyphicon glyphicon-globe"></i></button>
                        <?php else:?>
                            <a target="_blank" class="btn" 
                            href="http://translate.google.com/#en/<?php echo substr($edit_language,0,2)?>/<?php echo urlencode($original)?>">
                            <i class="glyphicon glyphicon-globe"></i></a>
                        <?php endif?>
                    </td>
                    <td>  
                        <textarea id="dest_<?php echo $id?>" style="width: 100%" name="translations[<?php echo $id?>]"><?php echo $translated?></textarea>
                    </td>
                </tr>
            <?php endforeach;?>
        
            </table>
            <button type="submit" class="btn btn-primary pull-right" name="translation[submit]"><i class="glyphicon glyphicon-hdd"></i> <?php echo __('Save')?></button>        
        </form>
    </div>
</div>

<div class="text-center">
    <?php echo $pagination?>
</div>