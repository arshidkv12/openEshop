<?php defined('SYSPATH') or die('No direct script access.');

class Api_User extends Api_Controller {


    public $user = FALSE;

    public function before()
    {
        parent::before();

        if (Theme::get('premium')!=1)
            $this->_error('You need a premium theme to use the API',401);
        
        $key = Core::request('user_token');

        //try authenticate the user
        if ($key == NULL OR ($this->user = Auth::instance()->api_login($key))==FALSE)
        {
            $this->_error(__('Wrong Api User Token'),401);
        }
    }



} // End api