<?phpdefined('SYSPATH') or exit('Install must be loaded from within index.php!');?>

<div class="page-header">
    <a class="btn btn-primary pull-right" id="phpinfobutton" >phpinfo()</a>
    <h1><?php echo __("Software Requirements")?>  v.<?php echo install::VERSION?></h1>
    <p><?php echo __('In this page you can see the requirements checks we do before we install.')?></p>
    <div class="clearfix"></div>
</div>

<?php foreach (install::requirements() as $name => $values):
    $color = ($values['result'])?'success':'danger';?>
    <div class="pull-left <?php echo $color?>" style=" width: 100px; height: 56px; text-align: center;">
        <h4><i class="glyphicon glyphicon-<?php echo ($values['result'])?"ok":"remove"?>"></i>
        <div class="clearfix"></div> 
        <?php printf ('<span class="label label-%s">%s</span>',$color,$name);?> </h4>
    </div>   
<?php endforeach?>

<div class="clearfix"></div><br>

<div class="hidden" id="phpinfo">
    <?php echo str_replace('<table', '<table class="table table-striped table-bordered"', install::phpinfo())?>
</div>