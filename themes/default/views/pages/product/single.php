<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="col-md-6">
	<?php if($images):?>
		<div class="carousel slide article-slide" id="article-photo-carousel">
		  	<!-- Wrapper for slides -->
		  	<div class="carousel-inner cont-slider">
			    <?php $i=0;
	            foreach ($images as $path => $value):?>
	                <?php if($images = $product->get_images()):?>
                        <?php if( isset($value['thumb']) AND isset($value['image']) ):?>
	                        <div class="item <?php echo ($i == 0)?'active':''?>">
		                        <a rel="prettyPhoto[gallery]" href="<?php echo $value['base'].$value['image']?>">
		                            <?php echo HTML::picture($value['base'].$value['image'], ['w' => 318, 'h' => 300], ['1200px' => ['w' => '318', 'h' => '300'], '992px' => ['w' => '440', 'h' => '300'], '768' => ['w' => '910', 'h' => '300']], ['alt' => HTML::chars($product->title).$i, 'class' => 'main-image'])?>
		                        </a>
	                        </div>               
                        <?php endif?>   
	                <?php endif?>
	            <?php $i++;
	            endforeach?>
		  	</div>
		  	<!-- Indicators -->
		  	<ol class="carousel-indicators">
		  		<?php $j=0;
		        foreach ($images as $path => $value):?>
			        <li class="<?php echo ($j == 0)?'active':'item'?>" data-slide-to="<?php echo $j?>" data-target="#article-photo-carousel">
			            <?php if($images = $product->get_images()):?>        
			                <?php if( isset($value['thumb']) AND isset($value['image']) ):?>
			                    <img src="<?php echo Core::imagefly($value['base'].$value['thumb'],100,54)?>" alt="<?php echo HTML::chars($product->title)?> <?php echo $j?>">
			                <?php endif?>   
			            <?php endif?>
			        </li>
		        <?php $j++;
		        endforeach?>
		  	</ol>
		</div>
	<?php else:?>
		<img src="//www.placehold.it/300x300&text=<?php echo urlencode(__('No Image'))?>" width="300" height="300" alt="<?php echo HTML::chars($product->title)?> <?php echo __('No Image')?>">
	<?php endif?>
</div>

<div class="col-md-6">

    <div class="page-header">
        <h1 class="single-h1"><?php echo $product->title?>
        <?php if ($product->rate!==NULL):?>
            <div class="rating" itemprop="rating" itemscope itemtype="http://data-vocabulary.org/Rating">
                <meta itemprop="value" content="<?php echo $product->rate?>" >
                <meta itemprop="best"  content="<?php echo Model_Review::RATE_MAX?>" />
                <a class="" href="<?php echo Route::url('product-review', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>" >
                    <?php for ($i=0; $i < round($product->rate); $i++):?>
                        <span class="glyphicon glyphicon-star"></span>
                    <?php endfor?>
                </a>
            </div>
       <?php endif?>
       <?php if (Auth::instance()->logged_in()):?>
       <?php if(Auth::instance()->get_user()->id_role==Model_Role::ROLE_ADMIN):?>
            <a title="<?php echo __('Edit')?>" class="btn btn-primary btn-xs" href="<?php echo Route::url('oc-panel', array('controller'=> 'product', 'action'=>'update','id'=>$product->id_product))?>">
                <i class="glyphicon glyphicon-edit"></i>
            </a>
       <?php endif?>
       <?php endif?>
   </h1>
    </div>

    <?php if (!empty($product->url_demo)):?>
        <?php if (($total_skins = count($skins)) > 0 AND Theme::get('premium')==1):?>
            <div class="btn-group pull-right">
                <a class="btn btn-warning btn-xs" href="<?php echo Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>"><?php echo __('Demo')?></a>
                <button class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu <?php echo ($total_skins > 10) ? 'multi-column-dropdown' : NULL?>" id="menu_type">
                    <?php foreach ($skins as $s):?>
                        <li><a title="<?php echo HTML::chars($s)?>" href="<?php echo Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>?skin=<?php echo $s?>"><?php echo $s?></a></li>
                    <?php endforeach?>
                </ul>
            </div>
        <?php else:?>
            <a class="btn btn-warning btn-xs pull-right" href="<?php echo Route::url('product-demo', array('seotitle'=>$product->seotitle,'category'=>$product->category->seoname))?>" >
            <i class="glyphicon glyphicon-eye-open"></i> <?php echo __('Demo')?></a>
        <?php endif?>
    <?php endif?>

	<?php if ($product->has_offer()):?>
	    <span class="offer">
	    	<h4><span class="label label-success">
	    		<i class="glyphicon glyphicon-bullhorn"></i>
	    	</span> <?php echo __('Offer')?> <?php echo $product->formated_price()?> 
	    	<del><?php echo $product->price.' '.$product->currency?></del> </h4>
	    </span>
		<span class="offer-valid"><?php echo __('Offer valid until')?> <?php echo (Date::format((Model_Coupon::current()->loaded())?Model_Coupon::current()->valid_date:$product->offer_valid))?></span>
	<?php else:?>
	    <?php if($product->final_price() != 0):?>
	        <h4><?php echo __('Price')?> : <span data-locale="<?php echo $product->currency?>" class="price-curry curry"><?php echo $product->formated_price()?></span></h4>
	    <?php else:?>
	        <h4><?php echo __('Free')?></h4>
	    <?php endif?>
	<?php endif?>

	<div class="button-space-review">
        <div class="clearfix"></div><br>
        <?php echo View::factory('pages/product/buy-button',array('product'=>$product))?>
	</div>

</div>

<div class="col-md-12">
<ul class="nav nav-tabs mb-30">
	  	<li class="active">
	  		<a href="#description" data-toggle="tab"><?php echo __('Description')?></a>	
	  	</li>
	  	<li><a href="#details" data-toggle="tab"><?php echo __('Details')?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="description">
			<?php echo Text::bb2html($product->description,TRUE)?>
		</div>
		<div class="tab-pane" id="details">
			<?php if(core::config('product.number_of_orders')):?>
				<p><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $number_orders?></p>
			<?php endif?>

            <?php if(core::config('product.count_visits')==1):?>
			     <p><?php echo __('Hits')?> : <?php echo $hits?></p>
            <?php endif?>

		    <?php if ($product->has_file()==TRUE):?>
			    <p><?php echo __('Product format')?> : <?php echo mb_strtoupper(strrchr($product->file_name, '.'))?> <?php echo __('file')?> </p>
			    <p><?php echo __('Product size')?> : <?php echo round(filesize(DOCROOT.'data/'.$product->file_name)/pow(1024, 2),2)?>MB</p>
		    <?php endif?>

		    <?php if ($product->support_days>0):?>
		    	<p><?php echo __('Professional support')?> : <?php echo $product->support_days?> <?php echo __('days')?></p>
		    <?php endif?>

		    <?php if ($product->licenses>0):?>
		    <p><?php echo __('Licenses')?> : <?php echo $product->licenses?>  
		        <?php if ($product->license_days>0):?>
		        	<?php echo __('valid')?> <?php echo $product->license_days?> <?php echo __('days')?>
		        <?php endif?>
		    </p>
		    <?php endif?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<br/>
<div class="coupon">
<?php echo View::factory('coupon')?>
</div>
<div class="clearfix"></div><br>
<?php echo $product->qr()?>
<?php echo $product->related()?>
<?php echo $product->disqus()?>