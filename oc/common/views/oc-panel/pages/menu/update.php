<?php defined('SYSPATH') or die('No direct script access.');?>

<h1 class="page-header page-title"><?php echo __('Edit Menu')?> <?php echo $menu_data['title']?></h1>
<hr>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
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
                
                <form class="form-horizontal"  method="post" action="<?php echo Route::url('oc-panel',array('controller'=>'menu','action'=>'update','id'=>$name))?>">
                <!-- drop down selector -->
                <div class="form-group" style="display:none;" id="categories-group">
                    <?php echo  FORM::label('category', __('Category'), array('class'=>'control-label col-sm-1', 'for'=>'category' ))?> 
                    <div class="col-sm-4">
                    <div class="accordion">
                
                    <?php function lili3($item, $key,$cats){?>
                        <div class="accordion-group">
                            <div class="accordion-heading"> 
                
                                <?php if (count($item)>0):?>
                                    <div class="radio">
                                    <label>
                                    <input <?php echo ($cats[$key]['seoname']==Core::get('category'))?'checked':''?> type="radio" id="radio_<?php echo $cats[$key]['seoname']?>" data-name="radio_<?php echo $cats[$key]['name']?>" class="menu_category"  value="<?php echo $cats[$key]['id']?>"> 
                                        <a class="btn btn-primary btn-xs" data-toggle="collapse" type="button"  
                                            data-target="#acc_<?php echo $cats[$key]['seoname']?>">                    
                                            <i class=" glyphicon   glyphicon-plus"></i> <?php echo $cats[$key]['name']?>
                                        </a>
                                    </label>
                                    </div>
                                    
                                <?php else:?>
                                    <div class="radio">
                                    <label>
                                    <input <?php echo ($cats[$key]['seoname']==Core::get('category'))?'checked':''?> type="radio" id="radio_<?php echo $cats[$key]['seoname']?>" data-name="radio_<?php echo $cats[$key]['name']?>" class="menu_category"  value="<?php echo $cats[$key]['id']?>"> 
                                    
                                        <a class="btn btn-xs btn-primary" data-toggle="collapse" type="button"  
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
                </div>
                
                <div class="form-group"  id="default-group" style="display:none;">
                    <?php echo  FORM::label('default_links_label', __('Default links'), array('class'=>'control-label col-sm-1', 'for'=>'default_links' ))?>
                    <div class="col-sm-4"> 
                        <div class="accordion" >
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                <div class="radio">
                                    <label>
                                    <input type="radio" class="default_links" id="radio_home"  name="home" data-url="" data-icon="glyphicon-home glyphicon" value="home">    
                                        <a class="btn btn-primary btn-xs" type="button"  >                    
                                             <?php echo __('Home')?>
                                        </a>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" class="default_links" id="radio_listing" name="listing" data-url="all" data-icon="glyphicon glyphicon-list" value="listing">
                                        <a class="btn btn-primary btn-xs" type="button"  >                    
                                             <?php echo __('listing')?>
                                        </a>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" class="default_links" id="radio_search" name="search" data-url="search.html" data-icon="glyphicon glyphicon-search" value="search">
                                        <a class="btn btn-primary btn-xs" type="button"  >                    
                                             <?php echo __('Search')?>
                                        </a>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" class="default_links" id="radio_contact" name="contact" data-url="contact.html" data-icon="glyphicon glyphicon-envelope" value="contact">
                                        <a class="btn btn-primary btn-xs" type="button"  >                    
                                             <?php echo __('contact')?>
                                        </a>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" class="default_links" id="radio_rss" name="rss" data-url="rss.xml" data-icon="glyphicon glyphicon-signal" value="rss">
                                        <a class="btn btn-primary btn-xs" type="button"  >                    
                                             <?php echo __('rss')?>
                                        </a>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" class="default_links" id="radio_map" name="map" data-url="map.html" data-icon="glyphicon glyphicon-globe" value="map">
                                        <a class="btn btn-primary btn-xs" type="button"  >                    
                                             <?php echo __('map')?>
                                        </a>
                                    </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-1"><?php echo __('Title')?></label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="title" value="<?php echo $menu_data['title']?>" placeholder="<?php echo __('Title')?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-1"><?php echo __('Url')?></label>
                    <div class="col-sm-4">
                        <input class="form-control" type="url" id="url" name="url" value="<?php echo $menu_data['url']?>" placeholder="http://somedomain.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <?php echo  FORM::label('target', __('Target'), array('class'=>'control-label col-sm-1', 'for'=>'target' ))?>
                    <div class="col-sm-4">
                    <?php echo  FORM::select('target', array('_self' => '_self', '_blank' => '_blank', '_parent' => '_parent', '_top' => '_top'), $menu_data['target'], array('class' => 'form-control', 'id' => 'target') )?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-1"><a target="_blank" href="http://getbootstrap.com/components/#glyphicons"><?php echo __('Icon')?></a></label>
                    <div class="col-sm-4">
                        <input class="form-control icon-picker" type="text" name="icon" value="<?php echo $menu_data['icon']?>">
                    </div>
                </div>
                
                <div class="form-actions">
                <a href="<?php echo Route::url('oc-panel',array('controller'=>'menu'))?>" class="btn btn-default ajax-load" title="<?php echo __('Cancel')?>"><?php echo __('Cancel')?></a>
                <button type="submit" class="btn btn-primary"><?php echo __('Save')?></button>
                </div>
                          
                
                </form>
            </div>
        </div>
    </div>
</div>