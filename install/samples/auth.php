<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'oc',
	'hash_method'  => 'sha256',
	'hash_key'     => '689s5h$@6bbxpd6w',
	'lifetime'     => 90*24*60*60,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',
	'cookie_salt'  => 'cookie_689s5h$@6bbxpd6w',
	'ql_key'       => 'ql_689s5h$@6bbxpd6w',
    'ql_lifetime'  => 7*24*60*60,
    'ql_separator' => '|',
	'ql_mode'      => 'AES-256-CBC',
	'ql_cipher'    => 'somerand',

);