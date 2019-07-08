<?phpdefined('SYSPATH') or exit('Install must be loaded from within index.php!');?>

<div class="page-header">
    <a class="btn btn-default pull-right" id="advanced-options" ><?php echo __("Advanced options")?></a>
    <h1><?php echo sprintf(__("Welcome to %s installation"), 'Open eShop v.'.install::VERSION)?></h1>
    <p>
        <?php echo __("Welcome to the super easy and fast installation")?>. 
            <a href="http://open-eshop.com/market/" target="_blank">
            <?php echo __("If you need any help please check our professional services")?></a>.
    </p>
    
    <div class="clearfix"></div>       
</div>

<?php if (!empty(install::$msg) OR !empty(install::$error_msg)):?>
    <?php install::view('hosting')?>
<?php endif?>

<form method="post" action="" class=" form-horizontal" >
    <div class="col-md-6" style="padding-left:0px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>1. <?php echo __('Site Configuration')?></h3>
            </div>
            <div class="panel-body">
                <div class="form-group">                
                    <div class="col-md-12">
                        <label class="control-label"><?php echo __("Site Language")?></label>
                        <select class="form-control" data-toggle="tooltip" title="<?php echo __("Site Language")?>" name="LANGUAGE" onchange="window.location.href='?LANGUAGE='+this.options[this.selectedIndex].value" required>
                            <?php 
                            $languages = scandir("languages");
                            foreach ($languages as $lang) 
                            {    
                                if( strpos($lang,'.')==false && $lang!='.' && $lang!='..' )
                                {
                                    $sel = ( strtolower($lang)==strtolower(install::$locale)) ? ' selected="selected"' : '';
                                    echo "<option$sel value=\"$lang\">$lang</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group adv">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Site URL");?>:</label>
                    <input type="text" size="75" name="SITE_URL" value="<?php echo core::request('SITE_URL',install::$url)?>"  class="form-control" data-toggle="tooltip" title="<?php echo __("Site URL");?>" required />
                    </div>
                </div>

                <div class="form-group adv">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Installation Folder");?>:</label>
                    <input  type="text" size="75" name="SITE_FOLDER" value="<?php echo core::request('SITE_FOLDER',install::$folder)?>"  class="form-control" data-toggle="tooltip" title="<?php echo __("Installation Folder");?>" required />
                    </div>
                </div>

                <div class="form-group">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Site Name")?>:</label>
                    <input  type="text" name="SITE_NAME" placeholder="<?php echo __("Site Name")?>" value="<?php echo core::request('SITE_NAME')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Site Name")?>" required />
                    </div>
                </div>

                <div class="form-group mb-10">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Time Zone")?>:</label>
                    <?php echo install::get_select_timezones('TIMEZONE',core::request('TIMEZONE',date_default_timezone_get()))?>
                    </div>
                </div>
            
                <ul class="nav nav-tabs" id="myTab" style="display:none;">
                  <li class="active"><a href="#install" data-toggle="tab"><?php echo __('New Install')?></a></li>
                  <li><a href="#upgrade" data-toggle="tab"><?php echo __('Reinstall System')?></a></li>
                </ul>
                 
                <div class="tab-content">

                    <div class="tab-pane active" id="install">
                        <div class="form-group">
                        
                            <div class="col-md-12">
                                <label class="control-label"><?php echo __("Administrator email")?>:</label>
                                <input type="email" name="ADMIN_EMAIL" value="<?php echo core::request('ADMIN_EMAIL')?>" placeholder="your@email.com" class="form-control" data-toggle="tooltip" title="<?php echo __("Administrator email")?>" required />
                            </div>
                        </div>

                        <div class="form-group">                        
                            <div class="col-md-12">
                                <label class="control-label"><?php echo __("Admin Password")?>:</label>
                                <input type="text" name="ADMIN_PWD" value="<?php echo core::request('ADMIN_PWD')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Admin Password")?>" required />   
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="upgrade">
                        <div class="form-group">
                        
                            <div class="col-md-12">
                                <label class="control-label"><?php echo __("Hash Key")?>:</label>
                                <input type="text" name="HASH_KEY" value="<?php echo core::request('HASH_KEY')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Hash Key")?>" />   
                                <span class="help-block"><?php echo __('You need the Hash Key to re-install. You can find this value if you lost it at')?> <code>/oc/config/auth.php</code></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6" style="padding-right:0px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>2. <?php echo __('Database Configuration')?></h3>
            </div>
            <div class="panel-body">
                <p><a target="_blank" href="http://docs.open-eshop.com/create-mysql-database/">How to create a MySQL database?</a></p>
                <div class="form-group">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Host name")?>:</label>
                    <input  type="text" name="DB_HOST" value="<?php echo core::request('DB_HOST','localhost')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Host name")?>" required />
                    </div>
                </div>

                <div class="form-group">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("User name")?>:</label>
                    <input  type="text" name="DB_USER"  value="<?php echo core::request('DB_USER','root')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("User name")?>"  required />
                    </div>
                </div>

                <div class="form-group">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Password")?>:</label>
                    <input type="text" name="DB_PASS" value="<?php echo core::request('DB_PASS')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Password")?>"  />       
                    </div>
                </div>

                <div class="form-group">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Database name")?>:</label>
                    <input type="text" name="DB_NAME" value="<?php echo core::request('DB_NAME','openeshop')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Database name")?>" required />
                    </div>
                </div>

                <div class="form-group adv">
                    <div class="col-sm-12">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="DB_CREATE" data-toggle="tooltip" title="<?php echo __("Will try to create the DB if doesn't exists. Root permissions required.")?>" />
                                <?php echo __("Create DB.")?>
                                <br>
                                
                        </label>
                    </div>
                    </div>
                </div>
                <div class="form-group adv">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Database charset")?>:</label>
                    <input type="text" name="DB_CHARSET" value="<?php echo core::request('DB_CHARSET','utf8')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Database charset")?>" required />
                    </div>
                </div>

                <div class="form-group adv">                
                    <div class="col-md-12">
                    <label class="control-label"><?php echo __("Table prefix")?>:</label>
                    <input type="text" name="TABLE_PREFIX" value="<?php echo core::request('TABLE_PREFIX','oe_')?>" class="form-control" data-toggle="tooltip" title="<?php echo __("Allows multiple installations in one database if you give each one a unique prefix")?>. <?php echo __("Only numbers, letters, and underscores")?>." required />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-actions">
        <input type="submit" name="action" id="submit" value="<?php echo __("Install")?>" class="btn btn-primary btn-lg " />
    </div>
    <div class="clearfix"></div>
          
</form>
