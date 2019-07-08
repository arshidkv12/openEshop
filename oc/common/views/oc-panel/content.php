<?php echo Theme::styles($styles,'default')?>   
<?php echo Theme::scripts($scripts,'header','default')?>

<?php echo Breadcrumbs::render('oc-panel/breadcrumbs')?>      
<?php echo Alert::show()?>

<?php echo $content?>

<?php echo Theme::scripts($scripts,'footer','default')?>
	    	
<?php echo (Kohana::$environment === Kohana::DEVELOPMENT)? View::factory('profiler'):''?>