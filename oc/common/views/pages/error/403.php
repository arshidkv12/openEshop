<?php defined('SYSPATH') or die('No direct script access.');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo Core::config('general.site_name')?> - <?php echo __('Private Site')?></title>

    <link href="//cdn.jsdelivr.net/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.jsdelivr.net/bootstrap.image-gallery/3.1.0/css/bootstrap-image-gallery.min.css" rel="stylesheet">
    <link href="//cdn.jsdelivr.net/blueimp-gallery/2.14.0/css/blueimp-gallery.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/blueimp-gallery/2.14.0/js/jquery.blueimp-gallery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.image-gallery/3.1.0/js/bootstrap-image-gallery.min.js"></script>

  </head>

  <body>
    <style type="text/css">
    /* Space out content a bit */
    body {
      padding-top: 20px;
      padding-bottom: 20px;
    }

    /* Customize container */
    @media (min-width: 768px) {
      .container {
        max-width: 730px;
      }
    }
    .container-narrow > hr {
      margin: 30px 0;
    }

    /* Main marketing message and sign up button */
    .jumbotron {
      text-align: center;
      border-bottom: 1px solid #e5e5e5;
    }
    .jumbotron .btn {
      padding: 14px 24px;
      font-size: 21px;
    }

    /* Responsive: Portrait tablets and up */
    @media screen and (min-width: 768px) {
      /* Remove the bottom border on the jumbotron for visual effect */
      .jumbotron {
        border-bottom: 0;
      }
    }
    </style>

    <div class="container">
        <?php echo Alert::show()?>
      <div class="jumbotron">
        <?php if(core::config('general.private_site_page') != ''):?>
      <?php $content = Model_Content::get_by_title(core::config('general.private_site_page'))?>
      <div class="page-header">
        <h1><?php echo $content->title?></h1>
      </div>
      <div class="text-description"><?php echo $content->description?></div>
      <br>
    <?php else:?>
      <div class="page-header">
        <h1><?php echo Core::config('general.site_name')?></h1>
        <h2><?php echo __('This is a private website, you need to login to see the content!')?></h2>
      </div>
    <?php endif?>
        
      </div>
      <form class="well form-horizontal auth" method="post" action="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'login'))?>">         
        <?php echo Form::errors()?>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo __('Email')?></label>
            <div class="col-md-5 col-sm-6">
                <input class="form-control" type="text" name="email" placeholder="<?php echo __('Email')?>">
            </div>
        </div>
         
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo __('Password')?></label>
            <div class="col-md-5 col-sm-6">
                <input class="form-control" type="password" name="password" placeholder="<?php echo __('Password')?>">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" checked="checked"><?php echo __('Remember me')?>
                    </label>
                </div>
            </div>
        </div>
        <div class="page-header"></div>     
        <div class="col-sm-offset-2">
            <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-user glyphicon"></i> <?php echo __('Login')?>
            </button>
            <a data-toggle="modal" data-dismiss="modal" class="btn btn-info" href="<?php echo Route::url('oc-panel',array('directory'=>'user','controller'=>'auth','action'=>'request'))?>#request-modal">
                <?php echo __('Request Access')?>
              </a>
        </div>
        <?php echo Form::CSRF('login')?>
    </form>         


    </div> 
    <div id="request-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal" >&times;</a>
                    <h3><?php echo __('Request Access')?></h3>
                </div>
                <div class="modal-body">
                    <?php echo View::factory('pages/auth/request-form')?>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
