<div class="page-header">
    <div class="dropdown pull-right">
        &nbsp;
        <button class="btn btn-default dropdown-toggle" type="button" id="datesMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span class="fa fa-tasks"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="datesMenu">
            <li><a href="?<?php echo http_build_query(['rel' => ''] + ['from_date' => date('Y-m-d', strtotime('-30 days'))] + ['to_date' => date('Y-m-d', strtotime('now'))] + Request::current()->query())?>"><?php echo __('Last 30 days')?></a></li>
            <li><a href="?<?php echo http_build_query(['rel' => ''] + ['from_date' => date('Y-m-d', strtotime('-1 month'))] + ['to_date' => date('Y-m-d', strtotime('now'))] + Request::current()->query())?>"><?php echo __('Last month')?></a></li>
            <li><a href="?<?php echo http_build_query(['rel' => ''] + ['from_date' => date('Y-m-d', strtotime('-3 months'))] + ['to_date' => date('Y-m-d', strtotime('now'))] + Request::current()->query())?>"><?php echo __('Last 3 months')?></a></li>
            <li><a href="?<?php echo http_build_query(['rel' => ''] + ['from_date' => date('Y-m-d', strtotime('-6 months'))] + ['to_date' => date('Y-m-d', strtotime('now'))] + Request::current()->query())?>"><?php echo __('Last 6 months')?></a></li>
            <li><a href="?<?php echo http_build_query(['rel' => ''] + ['from_date' => date('Y-m-d', strtotime('-1 year'))] + ['to_date' => date('Y-m-d', strtotime('now'))] + Request::current()->query())?>"><?php echo __('Last year')?></a></li>
            <li><a href="?<?php echo http_build_query(['rel' => ''] + ['from_date' => '2014-11-01'] + ['to_date' => date('Y-m-d', strtotime('now'))] + Request::current()->query())?>"><?php echo __('All time')?></a></li>
        </ul>
    </div>
    <form name="date" class="form-inline pull-right" method="post" action="<?php echo URL::current()?>">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><?php echo __('From')?></div>
                <input type="text" class="form-control" id="from_date" name="from_date" value="<?php echo $from_date?>" data-date="<?php echo $from_date?>" data-date-format="yyyy-mm-dd">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <span>-</span>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><?php echo __('To')?></div>
                <input type="text" class="form-control" id="to_date" name="to_date" value="<?php echo $to_date?>" data-date="<?php echo $to_date?>" data-date-format="yyyy-mm-dd">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="statcard statcard-success">
            <div class="p-a">
                <?php if (isset($products)) :?>
                    <span class="pull-right">
                        <a class="btn btn-sm <?php echo Core::get('compare_products') == 1 ? 'btn-primary' : 'btn-default'?>"
                            href="<?php echo Route::url('oc-panel', array('controller'=> Request::current()->controller(), 'action'=>Request::current()->action()))?>?<?php echo Core::get('compare_products') == 1 ? http_build_query(['rel' => ''] + ['compare_products' => ''] + Request::current()->query()) : http_build_query(['rel' => ''] + ['compare_products' => 1] + Request::current()->query())?>"
                        >
                            <i class="fa fa-fw fa-clone"></i> <?php echo __('Compare Plans')?>
                        </a>
                    </span>
                <?php endif?>
                <?php if (Core::get('compare_products') == 1) :?>
                    <span class="statcard-desc"><?php echo $title?></span>
                    <h2 class="statcard-number">
                        <?php echo __('Compare Plans')?>
                    </h2>
                <?php else :?>
                    <span class="statcard-desc"><?php echo $title?></span>
                    <h2 class="statcard-number">
                        <?php if ($current_total !== NULL) :?>
                            <?php echo $num_format == 'MONEY' ? i18n::format_currency($current_total) : Num::format($current_total, 0)?>
                        <?php else :?>
                            --
                        <?php endif?>
                    </h2>
                <?php endif?>
                <hr class="statcard-hr">
            </div>
            <?php
                $chart_colors = array(array('fill'        => 'rgba(33,150,243,.1)',
                                            'stroke'      => 'rgba(33,150,243,.8)',
                                            'point'       => 'rgba(33,150,243,.8)',
                                            'pointStroke' => 'rgba(33,150,243,.8)'),
               );
            ?>
            <?php echo Chart::line($current_by_date, array('height'  => 94,
                                                   'width'   => 378,
                                                   'options' => array('responsive'             => true,
                                                                      'maintainAspectRatio'    => true,
                                                                      'scaleShowVerticalLines' => false,
                                                                      'scales'                 => array('xAxes' => array(array('gridLines'=> array('display' => false))),
                                                                                                        'yAxes' => array(array('ticks'=> array('min' => 0)))),
                                                                      'legend'                 => array('display' => false),
                                                                      'tooltipTemplate'        => '<%= datasetLabel %><%= value %>',
                                                                      'multiTooltipTemplate'   => '<%= datasetLabel %><%= value %>',
                                                                      )
                                                   ),
                                                   $chart_colors)?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="statcard statcard-success">
            <ul class="nav nav-pills nav-justified text-center">
                <li role="presentation">
                    <div class="p-a">
                        <span class="statcard-desc"><?php echo __('Current')?></span>
                        <h2 class="statcard-number">
                            <?php if ($current_total !== NULL) :?>
                                <?php echo $num_format == 'MONEY' ? i18n::format_currency($current_total) : Num::format($current_total, 0)?>
                                <small class="delta-indicator <?php echo Num::percent_change($current_total, $past_total) < 0 ? 'delta-negative' : 'delta-positive'?>"><?php echo Num::percent_change($current_total, $past_total)?></small>
                            <?php else :?>
                                --
                            <?php endif?>
                        </h2>
                    </div>
                </li>
                <li role="presentation">
                    <div class="p-a">
                        <span class="statcard-desc"><?php echo __('1 Month Ago')?></span>
                        <h2 class="statcard-number">
                            <?php if ($month_ago_total !== NULL) :?>
                                <?php echo $num_format == 'MONEY' ? i18n::format_currency($month_ago_total) : Num::format($month_ago_total, 0)?>
                                <small class="delta-indicator <?php echo Num::percent_change($month_ago_total, $past_month_ago_total) < 0 ? 'delta-negative' : 'delta-positive'?>"><?php echo Num::percent_change($month_ago_total, $past_month_ago_total)?></small>
                            <?php else:?>
                                --
                            <?php endif?>
                        </h2>
                    </div>
                </li>
                <li role="presentation">
                    <div class="p-a">
                        <span class="statcard-desc"><?php echo __('3 Months Ago')?></span>
                        <h2 class="statcard-number">
                            <?php if ($three_months_ago_total !== NULL) :?>
                                <?php echo $num_format == 'MONEY' ? i18n::format_currency($three_months_ago_total) : Num::format($three_months_ago_total, 0)?>
                                <small class="delta-indicator <?php echo Num::percent_change($three_months_ago_total, $past_three_months_ago_total) < 0 ? 'delta-negative' : 'delta-positive'?>"><?php echo Num::percent_change($three_months_ago_total, $past_three_months_ago_total)?></small>
                            <?php else:?>
                                --
                            <?php endif?>
                        </h2>
                    </div>
                </li>
                <li role="presentation">
                    <div class="p-a">
                        <span class="statcard-desc"><?php echo __('6 Months Ago')?></span>
                        <h2 class="statcard-number">
                            <?php if ($six_months_ago_total !== NULL) :?>
                                <?php echo $num_format == 'MONEY' ? i18n::format_currency($six_months_ago_total) : Num::format($six_months_ago_total, 0)?>
                                <small class="delta-indicator <?php echo Num::percent_change($six_months_ago_total, $past_six_months_ago_total) < 0 ? 'delta-negative' : 'delta-positive'?>"><?php echo Num::percent_change($six_months_ago_total, $past_six_months_ago_total)?></small>
                            <?php else:?>
                                --
                            <?php endif?>
                        </h2>
                    </div>
                </li>
                <li role="presentation">
                    <div class="p-a">
                        <span class="statcard-desc"><?php echo __('12 Months Ago')?></span>
                        <h2 class="statcard-number">
                            <?php if ($twelve_months_ago_total !== NULL) :?>
                                <?php echo $num_format == 'MONEY' ? i18n::format_currency($twelve_months_ago_total) : Num::format($twelve_months_ago_total, 0)?>
                                <small class="delta-indicator <?php echo Num::percent_change($twelve_months_ago_total, $twelve_six_months_ago_total) < 0 ? 'delta-negative' : 'delta-positive'?>"><?php echo Num::percent_change($twelve_months_ago_total, $twelve_six_months_ago_total)?></small>
                            <?php else:?>
                                --
                            <?php endif?>
                        </h2>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <?php if (isset($products)) :?>
        <div class="col-md-12">
            <div class="statcard statcard-success">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo __('Plan')?></th>
                            <th><?php echo __('Customers')?></th>
                            <th><?php echo $title?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($products as $product):?>
                            <tr>
                                <td><?php echo $product->title?></td>
                                <td><strong class="text-highlighted"><?php echo $products_data[$product->id_product]['customers']?></strong></td>
                                <td>
                                    <strong class="text-highlighted">
                                        <?php echo $num_format == 'MONEY' ? i18n::format_currency($products_data[$product->id_product]['total']) : Num::format($products_data[$product->id_product]['total'], 0)?>
                                    </strong>
                                </td>
                                <td class="col-xs-2">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $current_total > 0 ? number_format(($products_data[$product->id_product]['total']/$current_total) * 100, 2) : 0?>%;">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif?>

</div>

<hr>
