<?php defined('SYSPATH') or die('No direct script access.');?>

<ul class="list-inline pull-right">
    <li>
        <form class="form-inline" method="get" action="<?php echo URL::current();?>">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="<?php echo __('Coupon name')?>" value="<?php echo core::get('name')?>">
            </div>
            <button type="submit" class="btn"><?php echo __('Search')?></button>
        </form>
    </li>
    <li>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#import-tool">
            <i class="fa fa-upload"></i>&nbsp; <?php echo __('Import')?>
        </button>
    </li>
    <li>
        <a class="btn btn-primary" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'bulk')) ?>">
            <i class="glyphicon glyphicon-list-alt"></i>
            <?php echo __('Bulk')?>
        </a>  
    </li>
    <li>
        <a class="btn btn-primary" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'create')) ?>">
            <i class="glyphicon glyphicon-pencil"></i>
            <?php echo __('New')?>
        </a>
    </li>
</ul>

<h1 class="page-header page-title">
    <?php echo Text::ucfirst(__($name))?>
    <a target="_blank" href="https://docs.yclas.com/how-to-use-coupon-system/">
        <i class="fa fa-question-circle"></i>
    </a>
</h1>
<hr>

<?php if (Theme::get('premium')!=1):?>
    <div class="alert alert-info fade in">
        <p>
            <strong><?php echo __('Heads Up!')?></strong> 
            <?php echo __('only available with premium themes!').'<br/>'.__('Upgrade your Yclas site to activate this feature.')?>
        </p>
        <p>
            <a class="btn btn-info" href="<?php echo Route::url('oc-panel',array('controller'=>'theme'))?>">
                <?php echo __('Browse Themes')?>
            </a>
        </p>
    </div>
<?php endif?>

<div class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo __('Name')?></th>
                    <th><?php echo __('Product')?></th>
                    <th><?php echo __('Discount')?></th>
                    <th><?php echo __('Number Coupons')?></th>
                    <th><?php echo __('Valid until')?></th>
                    <th class="hidden-sm hidden-xs"><?php echo __('Created')?></th>
                    <?php if ($controller->allowed_crud_action('delete') OR $controller->allowed_crud_action('update')):?>
                        <th><?php echo __('Actions') ?></th>
                    <?php endif?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($elements as $element):?>
                    <tr id="tr<?php echo $element->pk()?>">
                        <td><?php echo $element->name?></td>
                        <td>
                            <?php if (isset($element->produt)):?>
                                <?php echo $element->product->title?>
                            <?php elseif(method_exists('Model_Order','product_desc')):?>
                                <?php echo (($product_desc = Model_Order::product_desc($element->id_product)) == '') ? __('Any') : $product_desc?>
                            <?php else:?>
                                <?php echo $element->id_product?>
                            <?php endif?>
                        </td>
                        <td>
                            <?php echo ($element->discount_amount==0)?round($element->discount_percentage,0).'%':i18n::money_format($element->discount_amount)?>
                        </td>
                        <td><?php echo $element->number_coupons?></td>
                        <td><?php echo Date::format($element->valid_date, core::config('general.date_format'))?></td>
                        <td class="hidden-sm hidden-xs"><?php echo Date::format($element->created, core::config('general.date_format'))?></td>

                        <?php if ($controller->allowed_crud_action('delete') OR $controller->allowed_crud_action('update')):?>
                            <td class="nowrap">
                                <div class="btn-group">
                                    <?php if ($controller->allowed_crud_action('update')):?>
                                        <a title="<?php echo __('Edit')?>" class="btn btn-primary" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'update','id'=>$element->pk()))?>">
                                           <i class="glyphicon glyphicon-edit"></i>
                                        </a>
                                    <?php endif?>
                                    <?php if ($controller->allowed_crud_action('delete')):?>
                                        <a 
                                            href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'delete','id'=>$element->pk()))?>" 
                                            class="btn btn-danger index-delete" 
                                            data-title="<?php echo __('Are you sure you want to delete?')?>" 
                                            data-id="tr<?php echo $element->pk()?>" 
                                            data-btnOkLabel="<?php echo __('Yes, definitely!')?>" 
                                            data-btnCancelLabel="<?php echo __('No way!')?>">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    <?php endif?>
                                </div>
                            </td>
                        <?php endif?>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
    <div class="panel-footer text-right">
        <?php if ($controller->allowed_crud_action('export')):?>
            <a class="btn btn-success" href="<?php echo Route::url($route, array('controller'=> Request::current()->controller(), 'action'=>'export')) ?>" title="<?php echo __('Export')?>">
                <i class="fa fa-download"></i>
                &nbsp;<?php echo __('Export all')?>
            </a>                
        <?php endif?>
    </div>
</div>

<div class="text-center"><?php echo $pagination?></div>

<div class="modal fade" id="import-tool" tabindex="-1" role="dialog" aria-labelledby="importCoupons" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <?php echo FORM::open(Route::url('oc-panel',array('controller'=>'coupon','action'=>'import')), array('class'=>'', 'enctype'=>'multipart/form-data'))?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                    <h4 id="importCoupons" class="modal-title"><?php echo __('Upload CSV file')?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for=""><?php echo __('import coupons')?></label>
                        <input type="file" name="csv_file_coupons" id="csv_file_coupons" class="form-control"/>
                        <p class="help-block">
                            <?php echo __('Please use the correct CSV format')?>, <?php echo __('limited to 10.000 at a time')?>, <?php echo __('1 MB file')?>.
                            <br>
                            <?php echo __('Coupons')?>: <a href="https://cdn.rawgit.com/yclas/yclas/master/install/samples/import/coupons.csv"><?php echo __('download example')?>.</a>
                        </p>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel')?></button>
                    <?php echo FORM::button('submit', __('Upload'), array('type'=>'submit','id'=>'csv_upload', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'coupon','action'=>'import'))))?>
                </div>
            <?php echo FORM::close()?>
        </div>
    </div>
</div>