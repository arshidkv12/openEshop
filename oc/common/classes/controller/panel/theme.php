<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller Market seettings
 */


class Controller_Panel_Theme extends Auth_Controller {

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Themes'))->set_url(Route::url('oc-panel',array('controller'  => 'theme'))));

    }

    /**
     * theme options/settings
     * @return [view] Renders view with form inputs
     */
    public function action_options()
    {
        //clear skin and theme cookie
        if (Core::config('appearance.allow_query_theme')=='1') 
        {
            Cookie::set('skin_'.Theme::$theme, '', Core::config('auth.lifetime'));
            Cookie::set('theme', '', Core::config('auth.lifetime'));
        }
        
        $options = NULL;
        $data    = NULL;

        //this is how we manage the mobile options, or if we want to set other theme options without enableing it. ;)
        if($this->request->param('id'))
        {
           $options = Theme::get_options($this->request->param('id'));
           $data    = Theme::load($this->request->param('id'));
        }

        if ($options === NULL)
            $options = Theme::$options;

        if ($data === NULL)
            $data = Theme::$data;


        // validation active 
        //$this->template->scripts['footer'][]= '/js/oc-panel/settings.js';
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Theme Options')));     
        $this->template->title = __('Theme Options');

        $this->template->scripts['footer'][] = 'js/jscolor/jscolor.js';

        // save only changed values
        if($this->request->post())
        {
           
            //delete image
            foreach ($_POST as $key => $value) 
            {
                if (strpos($key,'delete_')!==FALSE)
                {
                    if ($options[$keyname = str_replace('delete_','',$key)]['display'] == 'logo')
                    {
                        $url = Theme::delete_image(Core::post($key));
                    
                        if ($url!==FALSE)
                            $data[$keyname] = $url;
                    }
                }
            }
            
            //for each file option upload
            foreach ($_FILES as $key=>$values) 
            {
                if ($options[$key]['display'] == 'logo')
                {
                    $url = Theme::upload_image($_FILES[$key], ($key=='favicon_url')?TRUE:FALSE);
                    //succesfully uploaded
                    if ($url!==FALSE)
                    {
                        $data[$key] = $url;
                        //get rid of previous image if any
                        Theme::delete_image(Theme::get($key));
                    }
                }
            }

            //for each option read the post and store it
            foreach ($_POST as $key => $value) 
            {
                if (isset($options[$key]))
                {
                    //if textarea allow HTML
                    if ($options[$key]['display'] == 'textarea')
                        $data[$key] = Kohana::$_POST_ORIG[$key];
                    else
                        $data[$key] = core::post($key);                    
                }
            }
            
            Theme::save($this->request->param('id'),$data);
            
            Alert::set(Alert::SUCCESS, __('Theme configuration updated'));
            $this->redirect(Route::url('oc-panel',array('controller'=>'theme','action'=>'options','id'=>$this->request->param('id'))));
        }

        $this->template->content = View::factory('oc-panel/pages/themes/options', array('options' => $options, 'data'=>$data));
    }


    /**
     * theme selector
     * @return [view] 
     */
    public function action_index()
    {
        // validation active 
        //$this->template->scripts['footer'][]= '/js/oc-panel/settings.js';
        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Themes')));  
        $this->template->title = __('Themes');     
        
        $this->template->scripts['footer'][] = 'js/oc-panel/license.js';

        //getting the themes
        $themes = Theme::get_installed_themes();

        $mobile_themes = Theme::get_installed_themes(TRUE);
  
        //getting themes from market
        $market = array();
        $json = Core::get_market();
        if(is_array($json))
        {    
            foreach ($json as $theme) 
            {
                //we add only those the user doesn't have installed
                if ( strtolower($theme['type']) == 'themes' 
                    AND!in_array(strtolower($theme['seoname']), array_keys($themes))
                    AND !in_array(strtolower($theme['seoname']), array_keys($mobile_themes)) )
                    $market[] = $theme;
            }
        }    

        // change the theme
        if($this->request->param('id'))
        {
            $theme = $this->request->param('id');

            $opt = Theme::get_options($theme);
            Theme::load($theme,FALSE);

            if (isset($opt['premium']) AND Core::config('license.number') == NULL)
            {
                 $this->redirect(Route::url('oc-panel',array('controller'=>'theme','action'=> 'license','id'=>$theme) ));
            }

            //activating a mobile theme
            if (in_array($theme, array_keys($mobile_themes)) )
            {
                Theme::set_mobile_theme($theme);
                Alert::set(Alert::SUCCESS, __('Mobile Theme updated'));
            }
            else
            {
                Theme::set_theme($theme);
                Alert::set(Alert::SUCCESS, __('Appearance configuration updated'));
            }
            
            $this->redirect(Route::url('oc-panel',array('controller'=>'theme','action'=> (!isset($opt['premium']))?'index':'options')));
        }

        $this->template->content = View::factory('oc-panel/pages/themes/theme', array('market' => $market,
                                                                                    'themes' => $themes, 
                                                                                    'mobile_themes' => $mobile_themes,
                                                                                    'selected'=>Theme::get_theme_info(Theme::$theme)));
    }


   /**
     * theme selector
     * @return [view] 
     */
    public function action_license()
    {
        $theme = $this->request->param('id',Theme::$theme);

        // save only changed values
        if(core::request('license'))
        {
            if (Theme::license(core::request('license'),$theme)==TRUE)
            {
                 //activating a mobile theme
                if (in_array($theme, array_keys(Theme::get_installed_themes(TRUE))) )
                    Theme::set_mobile_theme($theme);
                else
                    Theme::set_theme($theme);

                Model_Config::set_value('license','number',core::request('license'));
                Model_Config::set_value('license','date',time()+7*24*60*60);

                Alert::set(Alert::SUCCESS, __('Theme activated, thanks.'));
                $this->redirect(Route::url('oc-panel',array('controller'=>'theme','action'=> 'index')));
            }
            else
            {
                Alert::set(Alert::INFO, __('There was an error activating your license.'));
            }            
        }

        Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Theme License')));  
        $this->template->title = __('Theme License');     
        $this->template->scripts['footer'][] = 'js/oc-panel/license.js';

        $this->template->content = View::factory('oc-panel/pages/themes/license', array('theme' => Theme::$theme));
    }
    
    /**
    * install theme from selected zip file
    * @return redirect 
    */
    public function action_install_theme()
    {
        $zip_theme = $_FILES['theme_file']; //file post
        if ($zip_theme['name']=='' OR !Upload::type($zip_theme, array('zip'))) //check if it si of a right type
        {
            Alert::set(Alert::ALERT, $zip_theme['name'].' '.__('Is not valid format, please use ZIP format'));
            $this->redirect(Route::url('oc-panel',array('controller'=>'theme', 'action'=>'index')));
        }
        else
        {
            if($zip_theme != NULL) // sanity check 
            {   
                // saving/uploadng zip file to dir.
                $root = DOCROOT.'themes/'; //root folder
            
                 // save file to root folder, file, name, dir
                $file = Upload::save($zip_theme, $zip_theme['name'], $root);

                $zip = new ZipArchive;

                // open zip file, and extract to root dir
                if ($zip_open = $zip->open($root.$zip_theme['name'])) 
                {
                    $zip->extractTo($root);
                    $zip->close();
                    unlink($root.$zip_theme['name']);
                } 
                else 
                {
                    Alert::set(Alert::ALERT, $zip_theme['name'].' '.__('Zip file failed to extract, please try again.'));
                    $this->redirect(Route::url('oc-panel',array('controller'=>'theme', 'action'=>'index')));
                }

                //check license from the zip name
                //$license = substr($zip_theme['name'],0, -4);

                Alert::set(Alert::SUCCESS, $zip_theme['name'].' '.__('You have successfully installed the theme!'));
                $this->redirect(Route::url('oc-panel',array('controller'=>'theme', 'action'=>'index')));
            }
            
        }
    }

    /**
     * mobile theme selector
     * @return [view] 
     */
    public function action_mobile()
    {

        // save only changed values
        if($this->request->param('id'))
        {
            Theme::set_mobile_theme($this->request->param('id'));
            
            Alert::set(Alert::SUCCESS, __('Mobile Theme updated'));
            $this->redirect(Route::url('oc-panel',array('controller'=>'theme','action'=>'index')));
        }

       
    }


    /**
     * download theme from license key
     * @return [view] 
     */
    public function action_download()
    {
        // save only changed values
        if($license = core::request('license'))
        {
            if (($theme = Theme::download($license))!=FALSE)
            {
                Alert::set(Alert::SUCCESS, __('Theme downloaded').' '.$theme);
                $this->redirect(Route::url('oc-panel',array('controller'=>'theme', 'action'=>'license','id'=>$theme)).'?license='.$license);
            }
        }

        Alert::set(Alert::ALERT, __('Theme could not be downloaded'));
        $this->redirect(Route::url('oc-panel',array('controller'=>'theme', 'action'=>'index')));
    }

    /**
     * custom css for default theme
     * @return [view] 
     */
    public function action_css()
    {
        // validation active 
        //$this->template->scripts['footer'][]= '/js/oc-panel/settings.js';
        $this->template->title = __('Custom CSS');
        Breadcrumbs::add(Breadcrumb::factory()->set_title($this->template->title));  

        $css_active  = Core::post('css_active',Core::Config('appearance.custom_css'));
        $css_content = Core::curl_get_contents(Theme::get_custom_css());
        if ($css_content===NULL)
            Alert::set(Alert::ERROR, sprintf(__('We can not read file %s'),Theme::get_custom_css() ));

        // change the CSS
        if( ($new_css = Core::post('css'))!==NULL )
        {            
            //save css file
            $file = Theme::theme_folder('default').'/css/web-custom.css';
            if (File::write($file,$new_css))
            {
                Core::S3_upload($file,'css/web-custom.css');

                //active or not? switch
                $css_active = Core::post('css_active');
                Model_Config::set_value('appearance','custom_css',$css_active);

                //increase version number
                Model_Config::set_value('appearance','custom_css_version',Core::Config('appearance.custom_css_version')+1);

                $css_content = $new_css;

                Alert::set(Alert::SUCCESS, __('CSS file saved'));
            }
            else
                Alert::set(Alert::ERROR, __('CSS file not saved'));
            
        }

        $this->template->content = View::factory('oc-panel/pages/themes/css', array('css_content' => $css_content,
                                                                                    'css_version' => Core::Config('appearance.custom_css_version'),
                                                                                    'css_active'  => $css_active
                                                                                    ));
    }



}//end of controller