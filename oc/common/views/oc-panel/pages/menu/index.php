<?php defined('SYSPATH') or die('No direct script access.');?>

<ul class="list-inline pull-right">
    <li>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-menu-item">
            <i class="fa fa-plus-circle"></i>&nbsp; <?php echo __('Create Menu Item')?>
        </button>
    </li>
</ul>

<h1 class="page-header page-title">
    <?php echo __('Custom menu')?>
    <a target="_blank" href="https://docs.yclas.com/modify-top-menu/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <ol class='plholder' id="ol_1" data-id="1">
                    <?php if (is_array($menu)):?>
                        <?php foreach($menu as $key=>$data):?>
                            <li data-id="<?php echo $key?>" id="<?php echo $key?>">
                                <div class="drag-item">
                                    <span class="drag-icon"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span>
                                    <div class="drag-name">
                                        <?php if($data['icon']!=''):?><i class="<?php echo $data['icon']?>"></i><?php endif?>
                                        <span class="label label-info "><?php echo $data['title']?></span>
                                        <?php echo $data['url']?> (<?php echo $data['target']?>)
                                    </div>
                                    <a class="drag-action ajax-load" title="<?php echo __('Edit')?>"
                                        href="<?php echo Route::url('oc-panel', array('controller'=>'menu','action'=>'update','id'=>$key))?>">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a 
                                        href="<?php echo Route::url('oc-panel', array('controller'=> 'menu', 'action'=>'delete','id'=>$key))?>"
                                        class="drag-action index-delete" 
                                        title="<?php echo __('Are you sure you want to delete?')?>" 
                                        data-id="<?php echo $key?>" 
                                        data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                                        data-btnCancelLabel="<?php echo __('No way!')?>">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach?>
                    <?php endif?>
                </ol><!--ol_1-->
                <span id='ajax_result' data-url='<?php echo Route::url('oc-panel',array('controller'=>'menu','action'=>'saveorder'))?>'></span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-menu-item" tabindex="-1" role="dialog" aria-labelledby="createMenu" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'menu','action'=>'new'))?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                    <h4 id="createMenu" class="modal-title"><?php echo __('Create Menu Item')?></h4>
                </div>
                <div class="modal-body">
                    <div class="btn-group btn-primary pull-right">
                        <button class="btn btn-primary"><?php echo __('Menu type')?></button>
                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="menu_type">
                            <!-- dropdown menu links -->
                            <li><a class="custom"><?php echo __('Custom')?></a></li>
                            <li><a class="categories"><?php echo __('Categories')?></a></li>
                            <li><a class="default"><?php echo __('Default')?></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <!-- drop down selector -->
                    <div class="form-group" style="display:none;" id="categories-group">
                        <?php echo  FORM::label('category', __('Category'), array('class'=>'control-label', 'for'=>'category' ))?> 
                        <div class="accordion">
                            <?php function lili3($item, $key,$cats){?>
                                <div class="accordion-group">
                                    <div class="accordion-heading"> 
                        
                                        <?php if (count($item)>0):?>
                                            <div class="radio radio-success">
                                                <input <?php echo ($cats[$key]['seoname']==Core::get('category'))?'checked':NULL?> value="<?php echo $cats[$key]['id']?>" type="radio" id="radio_<?php echo $cats[$key]['seoname']?>" data-name="radio_<?php echo $cats[$key]['name']?>" class="menu_category">
                                                <label for="radio_<?php echo $cats[$key]['seoname']?>">
                                                    <a class="btn btn-primary btn-xs" 
                                                        data-toggle="collapse"
                                                        type="button"  
                                                        data-target="#acc_<?php echo $cats[$key]['seoname']?>">
                                                        <i class="glyphicon glyphicon-plus"></i> <?php echo $cats[$key]['name']?>
                                                    </a>
                                                </label>
                                            </div>                        
                                        <?php else:?>
                                            <div class="radio radio-success">
                                                <input <?php echo ($cats[$key]['seoname']==Core::get('category'))?'checked':NULL?> value="<?php echo $cats[$key]['id']?>" type="radio" id="radio_<?php echo $cats[$key]['seoname']?>" data-name="radio_<?php echo $cats[$key]['name']?>" class="menu_category">
                                                <label for="radio_<?php echo $cats[$key]['seoname']?>">
                                                    <a class="btn btn-xs btn-primary" 
                                                        data-toggle="collapse"
                                                        type="button"  
                                                        data-target="#acc_<?php echo $cats[$key]['seoname']?>">
                                                        <?php echo $cats[$key]['name']?>
                                                    </a>
                                                </label>
                                            </div>
                                        <?php endif?>
                                    </div>
                        
                                    <?php if (count($item)>0):?>
                                        <div id="acc_<?php echo $cats[$key]['seoname']?>" 
                                            class="accordion-body collapse <?php echo ($cats[$key]['seoname']==Core::get('category'))?'in':''?>">
                                            <div class="accordion-inner">
                                                <?php if (is_array($item)) array_walk($item, 'lili3', $cats);?>
                                            </div>
                                        </div>
                                    <?php endif?>
                        
                                </div>
                            <?php }array_walk($order_categories, 'lili3',$categories);?>                    
                        </div>
                    </div>
                    
                    <div class="form-group"  id="default-group" style="display:none;">
                        <?php echo FORM::label('default_links_label', __('Default links'), array('class'=>'control-label', 'for'=>'default_links' ))?>
                        <div class="accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <div class="radio radio-success">
                                        <input type="radio" class="default_links" id="radio_home" name="home" data-url="" data-icon="glyphicon-home glyphicon" value="home">
                                        <label for="radio_home">
                                            <a class="btn btn-primary btn-xs" type="button">
                                                <?php echo __('Home')?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" class="default_links" id="radio_listing" name="listing" data-url="all" data-icon="glyphicon glyphicon-list" value="listing">
                                        <label for="radio_listing">
                                            <a class="btn btn-primary btn-xs" type="button">
                                                <?php echo __('listing')?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" class="default_links" id="radio_search" name="search" data-url="search.html" data-icon="glyphicon glyphicon-search" value="search">
                                        <label for="radio_search">
                                            <a class="btn btn-primary btn-xs" type="button">
                                                <?php echo __('Search')?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" class="default_links" id="radio_contact" name="contact" data-url="contact.html" data-icon="glyphicon glyphicon-envelope" value="contact">
                                        <label for="radio_contact">
                                            <a class="btn btn-primary btn-xs" type="button">
                                                <?php echo __('contact')?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" class="default_links" id="radio_rss" name="rss" data-url="rss.xml" data-icon="glyphicon glyphicon-signal" value="rss">
                                        <label for="radio_rss">
                                            <a class="btn btn-primary btn-xs" type="button">
                                                <?php echo __('rss')?>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="radio radio-success">
                                        <input type="radio" class="default_links" id="radio_map" name="map" data-url="map.html" data-icon="glyphicon glyphicon-globe" value="map">
                                        <label for="radio_map">
                                            <a class="btn btn-primary btn-xs" type="button">
                                                <?php echo __('map')?>
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label"><?php echo __('Title')?></label>
                        <input class="form-control" type="text" name="title" value="<?php echo Core::post('title')?>" placeholder="<?php echo __('Title')?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label"><?php echo __('Url')?></label>
                        <input class="form-control" type="url" id="url" name="url" value="<?php echo Core::post('Url')?>" placeholder="http://somedomain.com" required>
                    </div>
                    
                    <div class="form-group">
                        <?php echo FORM::label('target', __('Target'), array('class'=>'control-label', 'for'=>'target' ))?>
                        <select name="target" id="target" class="form-control" REQUIRED>
                            <option>_self</option>
                            <option>_blank</option>
                            <option>_parent</option>
                            <option>_top</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label"><a target="_blank" href="http://getbootstrap.com/components/#glyphicons"><?php echo __('Icon')?></a></label>
                        <input class="form-control icon-picker" type="text" name="icon" value="<?php echo Core::post('icon')?>">
                    </div>                    
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel')?></button>
                    <button type="submit" class="btn btn-primary"><?php echo __('Save')?></button>
                </div>
            <?php echo FORM::close()?>
        </div>
    </div>
</div>
