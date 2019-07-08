<?php defined('SYSPATH') OR die('No direct script access.');

return array(

	'default' => array(
		/**
		 * The following options must be set:
		 *
		 * string   key     secret passphrase
		 * integer  mode    encryption mode, one of MCRYPT_MODE_*
		 * integer  cipher  encryption cipher, one of the Mcrpyt cipher constants
		 */
		'key'    => 'ql_689s5h$@6bbxpd6w',
		'cipher' => 'somerand',
		'mode'   => 'AES-256-CBC',
	),

);
