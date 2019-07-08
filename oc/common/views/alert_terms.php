<?php defined('SYSPATH') or die('No direct script access.');?>
<?php if(!isset($_COOKIE['accept_terms']) AND core::config('general.alert_terms') != ''):?>
<div id="accept_terms_modal" class="modal fade" data-backdrop="static">
	<?php $content = Model_Content::get_by_title(core::config('general.alert_terms'))?>
	<div class="modal-dialog">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick='location.href="http://www.google.com"' aria-hidden="true">&times;</button>
				<h1><?php echo $content->title?></h1>
			</div>
			<div class="modal-body">
				<div class="text-description"><?php echo Text::bb2html($content->description,TRUE,FALSE)?></div>
			</div>
			<div class="modal-footer">
				<a name="decline_terms" class="btn btn-default" onclick='location.href="http://www.google.com"' ><?php echo _e('No')?></a>
				<a name="accept_terms" class="btn btn-success" onclick='setCookie("accept_terms",1,10000)' data-dismiss="modal" aria-hidden="true"><?php echo _e('I accept')?></a>
			</div>
		</div>
	</div>
</div>
<?php endif?>