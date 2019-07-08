<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if (count($market)>=1):?>
<?php $i=0;
foreach ($market as $item):?>
    <?php if ($i%3==0):?><div class="clearfix"></div><?php endif?>
    <div class="col-md-4 col-sm-4 theme">
    <div class="thumbnail <?php if ( $item['price_offer']>0 AND strtotime($item['offer_valid'])>time()):?>alert-success<?php endif?>" >

        <?php if (empty($item['url_screenshot'])===FALSE):?>
            <img  class="thumb_market" src="<?php echo $item['url_screenshot']?>">
        <?php else:?>
             <img class="thumb_market" src="//www.placehold.it/300x200&text=<?php echo $item['title']?>">
        <?php endif?>   
        
        <div class="caption">
            <h3><?php echo $item['title']?></h3>
            <p>
                <?php if ( $item['price_offer']>0 AND strtotime($item['offer_valid'])>time()):?>
                    <span class="label label-danger">$<?php echo $item['price_offer']?></span>
                    <span class="label label-info"><del>$<?php echo $item['price']?></del></span>
                <?php else:?>
                    <span class="label label-info">$<?php echo $item['price']?></span>
                <?php endif?>
                <span class="label label-success"><?php echo $item['type']?></span>
                <?php if (empty($item['url_demo'])===FALSE):?>
                    <a class="btn btn-default btn-xs" target="_blank" href="<?php echo $item['url_demo']?>">
                        <i class="glyphicon  glyphicon-eye-open"></i>
                            <?php echo __('Preview')?>
                    </a>    
                <?php endif?>
            </p>
            <p>
                <?php echo Text::bb2html($item['description'])?>
            </p>
            <?php if ( $item['price_offer']>0 AND strtotime($item['offer_valid'])>time()):?>
            <p>
                <a href="<?php echo $item['url_buy']?>" class="btn btn-block btn-danger oe_button" data-toggle="modal" data-target="#marketModal"><?php echo __('Limited Offer!')?> $<?php echo $item['price_offer']?></a>
                <a href="<?php echo $item['url_buy']?>" class="btn btn-block btn-info oe_button" data-toggle="modal" data-target="#marketModal"><i class="glyphicon  glyphicon-time glyphicon"></i> <?php echo __('Valid Until')?>  <?php echo  Date::format($item['offer_valid'], core::config('general.date_format'))?></a>
            </p>
            <?php endif?>
            <p>
                <a class="btn btn-primary oe_button" data-toggle="modal" data-target="#marketModal" href="<?php echo $item['url_buy']?>">
                    <i class="glyphicon  glyphicon-shopping-cart"></i>  <?php echo __('Buy Now')?>
                </a>
            </p>
        </div>
    </div>
    </div>
    <?php $i++;
    endforeach?>
<?php endif?>

    <div class="col-md-4 col-sm-4 theme">
    <div class="thumbnail" >

        <img  class="thumb_market" src="https://open-classifieds.com/files/market/custom.png">
       
        
        <div class="caption">
            <h3>Custom Theme</h3>
            <p>
                <span class="label label-info">From $200</span>
                <span class="label label-success">themes</span>
            </p>

            <p>
                Want to make your classified ads site unique to look more professional for your customers? You can have a theme designed specially for you!
            </p>
            
            <p>
                <a class="btn btn-primary"  href="https://yclas.com/contact.html">
                    <i class="glyphicon  glyphicon-shopping-cart"></i>  Get a quote!
                </a>                
            </p>
        </div>
    </div>
    </div>