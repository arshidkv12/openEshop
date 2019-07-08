<?php defined('SYSPATH') or die('No direct script access.');?>
<?php echo Form::errors()?>

<div class="page-header">
    <h1><?php echo __('New Product')?></h1>
</div>

<div class="row">
    <?php echo  FORM::open(Route::url('oc-panel',array('controller'=>'product','action'=>'create')), array('class'=>'form-horizontal product_form', 'enctype'=>'multipart/form-data'))?>
        <fieldset>
    
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-primary product-panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-cog"></span> <?php echo __('General information')?></h3>
                </div>
                  <div class="panel-body">
                        <!-- drop down selector -->
                        <div class="form-group">
                            <label for="category" class="col-md-12"><?php echo __('Category')?> <span class="star-required">*</span></label>
                            <div class="col-md-12"> 
                            <?php function lili3($item, $key,$cats){?>
                                <div class="accordion-group">
                                    <div class="accordion-heading"> 
    
                                        <?php if (count($item)>0):?>
                                            <div class="radio">
                                                <label>
                                                    <input <?php echo ($cats[$key]['seoname']==Core::get('category'))?'checked':''?> type="radio" id="radio_<?php echo $cats[$key]['seoname']?>" name="id_category" value="<?php echo $cats[$key]['id']?>" required>
                                                    <a class="btn btn-primary btn-xs" data-toggle="collapse" type="button"  
                                                        data-target="#acc_<?php echo $cats[$key]['seoname']?>">                    
                                                        <i class=" glyphicon glyphicon-plus"></i> <?php echo $cats[$key]['name']?>
                                                    </a>
                                                </label>
                                            </div>
                                        <?php else:?>
                                            <div class="radio">
                                                <label>
                                                    <input <?php echo ($cats[$key]['seoname']==Core::get('category'))?'checked':''?> type="radio" id="radio_<?php echo $cats[$key]['seoname']?>" name="id_category" value="<?php echo $cats[$key]['id']?>" required>
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
                        <div class="form-group">
                            <label for="price" class="col-md-12"><?php echo __('Price')?> <span class="star-required">*</span></label>
                            <div class="col-md-12">
                                <?php echo  FORM::input('price', Request::current()->post('price'), array('placeholder' => i18n::money_format(1), 'class' => 'form-control', 'id' => 'price', 'type'=>'text', 'required'))?>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="currency" class="col-md-12"><?php echo __('Currency')?> <span class="star-required">*</span></label>
                            <div class="col-md-12">
                                <select name="currency" id="currency" class="form-control" required="required">
                                    <option></option>
                                    <?php foreach ($currency as $curr):?>
                                        <option value="<?php echo $curr?>"><?php echo $curr?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group">
                        <label for="title" class="col-md-12"><?php echo __('Title')?> <span class="star-required">*</span></label>
                            <div class="col-md-12">
                                <?php echo  FORM::input('title', Request::current()->post('title'), array('placeholder' => __('Title'), 'class' => 'form-control', 'id' => 'title', 'required'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="description" class="col-md-12"><?php echo __('Description')?> <span class="star-required">*</span></label>
                            <div class="col-md-12">
                                <?php echo  FORM::textarea('description', Request::current()->post('description'), array('class'=>'form-control', 'name'=>'description', 'id'=>'description' ,  'rows'=>10, 'required'))?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="panel panel-primary product-panel">
                    <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> <?php echo __('Details')?></div>
                      <div class="panel-body">
    
                        <?php if(Core::config('affiliate.active')==1 AND Theme::get('premium')==1):?>
                        <div class="form-group">
                            <?php echo  FORM::label('affiliate_percentage', __('Affiliate commission %'), array('class'=>'col-md-12 ', 'for'=>'affiliate_percentage'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('affiliate_percentage', Request::current()->post('affiliate_percentage'), array('placeholder' => i18n::money_format(1), 'class' => 'form-control', 'id' => 'affiliate_percentage', 'type'=>'text'))?>
                            </div>
                        </div>
                        <?php endif?>
    
                        <div class="form-group">
                            <?php echo  FORM::label('price_offer', __('Price Offer'), array('class'=>'col-md-12 ', 'for'=>'price_offer'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('price_offer', Request::current()->post('price_offer'), array('placeholder' => i18n::money_format(1), 'class' => 'form-control', 'id' => 'price_offer', 'type'=>'text'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('offer_valid', __('Offer Valid'), array('class'=>'col-md-12', 'for'=>'offer_valid'))?>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input  type="text" size="16" id="offer_valid" name="offer_valid"  value="" class="form-control " data-date="" data-date-format="yyyy-mm-dd">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary product-panel">
                    <div class="panel-heading">
                        <span class="fa fa-life-ring"></span> <?php echo __('Support Details')?>
                    </div>
                    <div class="panel-body">
                          <div class="form-group">
                            <?php echo  FORM::label('licenses', __('Licenses'), array('class'=>'col-md-12 ', 'for'=>'licenses'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('licenses', Request::current()->post('licenses'), array('placeholder' => '1', 'class' => 'form-control', 'id' => 'licenses', 'type'=>'text'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('license_days', __('License Days'), array('class'=>'col-md-12 ', 'for'=>'license_days'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('license_days', Request::current()->post('license_days'), array('placeholder' => '0', 'class' => 'form-control', 'id' => 'license_days', 'type'=>'text'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('support_days', __('Support Days'), array('class'=>'col-md-12 ', 'for'=>'support_days'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('support_days', Request::current()->post('support_days'), array('placeholder' => '365', 'class' => 'form-control', 'id' => 'support_days', 'type'=>'text'))?>
                            </div>
                        </div>
    
                      </div>
                  </div>
              </div>
    
            <div class="col-md-4 col-sm-6 col-xs-6">
                <div class="panel panel-primary product-panel">
                    <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> <?php echo __('Additional information')?></div>
                      <div class="panel-body">
    
                        <div class="form-group">
                            <?php echo  FORM::label('url_buy', __('Url to buy external'), array('class'=>'col-md-12 ', 'for'=>'url_buy'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('url_buy', Request::current()->post('url_buy'), array('placeholder' => __('http://open-eshop.com'), 'class' => 'form-control', 'id' => 'url_buy', 'type' => 'url'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('url_demo', __('Url demo'), array('class'=>'col-md-12 ', 'for'=>'url_demo'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('url_demo', Request::current()->post('url_demo'), array('placeholder' => __('http://open-eshop.com'), 'class' => 'form-control', 'id' => 'url_demo', 'type' => 'url'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('version', __('Version'), array('class'=>'col-md-12 ', 'for'=>'version'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('version', Request::current()->post('version'), array('placeholder' => '1.0.0', 'class' => 'form-control', 'id' => 'version', 'type' => 'text'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('skins', __('Skins'), array('class'=>'col-md-12 ', 'for'=>'skins'))?>
                            <div class="col-md-12">
                                <?php echo  FORM::input('skins', Request::current()->post('skins'), array('placeholder' => 'Hit enter to confirm', 'class' => 'form-control', 'id' => 'skins', 'type' => 'text','data-role'=>'tagsinput'))?>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('featured', __('Feature product'), array('class'=>'col-md-12 ', 'for'=>'featured'))?>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input  type="text" size="16" id="featured" name="featured"  value="" class="form-control" data-date="" data-date-format="yyyy-mm-dd">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <?php echo  FORM::label('email_purchase_notes', __('Purchase notes, sent via email'), array('class'=>'col-md-12 ', 'for'=>'email_purchase_notes', 'spellcheck'=>TRUE))?>
                            <div class="col-md-12">
                                <?php echo  FORM::textarea('email_purchase_notes', Request::current()->post('email_purchase_notes'), array('class'=>'form-control', 'name'=>'email_purchase_notes', 'id'=>'email_purchase_notes' , 'rows'=>10))?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCT FILES -->
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="panel panel-primary product-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-file"></span> <?php echo __('Upload files')?></h3>
                    </div>
                      <div class="panel-body">
    
                        <div class="panel-title">
                            <h2><small><?php echo __('Select product images')?></small></h2> 
                          </div>
                        <?php for ($i=0; $i < core::config('product.num_images') ; $i++):?>
    
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150&text=<?php echo urlencode(__('Image'))?>" width="200" height="150" alt="<?php echo __('Image')?>">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                  <div>
                                    <span class="btn btn-default btn-file">
                                    <span class="fileinput-new"><?php echo __('Select image')?></span>
                                    <span class="fileinput-exists"><?php echo __('Change')?></span>
                                    <input type="file" name="<?php echo 'image'.$i?>" id="<?php echo 'fileInput'.$i?>"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo __('Remove')?></a>
                                  </div>
                            </div>
                        <?php endfor?>
                        <hr>
                        <div class="panel-title">
                            <h2><small><?php echo __('Digital file')?></small></h2> 
                            <p>upload_max_filesize: <?php echo ini_get('upload_max_filesize')?>, max_execution_time:<?php echo ini_get('max_execution_time')?></p>
                          </div>
    
                        <div class="col-md-12">
                            <div class="clearfix"></div> <br>
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span><?php echo __('Add File')?></span>  
                                <input id="fileupload" type="file" data-url="upload" name="fileupload" data-size="<?php echo core::config('product.max_size')*1024*1024?>">
                            </span>
                            <div class="clearfix"></div><br>
    
                            <div class="drop-down-box"><span class="fileinput-new"><?php echo __('Drag & Drop file here')?></span></div>
    
                            <div class="clearfix"></div> <br>
                            <div id="progress" class="progress">
                                <div class="bar progress-bar progress-bar-success" style="width: 0%;"></div>
                            </div>
    
                            <input id="uploadedfile" type="hidden" name="file_name">
                            <div id="name-files" class="name-files"></div>
                            <div id="files" class="files"></div>
                            <button id="delete-button-file" class="hide btn btn-danger"><?php echo __('Delete')?></button>
                        </div>
    
    
                        <div class="clearfix"></div><br>
                        <div class="pull-right">
                            <?php echo  FORM::button('submit', __('Save'), array('type'=>'submit', 'class'=>'btn btn-primary btn-lg', 'action'=>Route::url('oc-panel',array('controller'=>'product','action'=>'create'))))?>
                            <div class="">
                                <div class="checkbox ">
                                    <label>
                                          <input type="checkbox" name="status" checked="checked">  &nbsp; <?php echo __('Active')?>?
                                    </label>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    <?php echo  FORM::close()?>
</div>