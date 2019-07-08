<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * The Encrypt library provides two-way encryption of text and binary strings
 * using the [Mcrypt](http://php.net/mcrypt) extension, which consists of three
 * parts: the key, the cipher, and the mode.
 *
 * The Key
 * :  A secret passphrase that is used for encoding and decoding
 *
 * The Cipher
 * :  A [cipher](http://php.net/mcrypt.ciphers) determines how the encryption
 *    is mathematically calculated. By default, the "rijndael-128" cipher
 *    is used. This is commonly known as "AES-128" and is an industry standard.
 *
 * The Mode
 * :  The [mode](http://php.net/mcrypt.constants) determines how the encrypted
 *    data is written in binary form. By default, the "nofb" mode is used,
 *    which produces short output with high entropy.
 *
 * @package    Kohana
 * @category   Security
 * @author     Kohana Team
 * @copyright  (c) 2007-2012 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Kohana_Encrypt {

	/**
	 * @var  string  default instance name
	 */
	public static $default = 'default';

	/**
	 * @var  array  Encrypt class instances
	 */
	public static $instances = array();

	/**
	 * @var  string  RAND type to use
	 *
	 * Only MCRYPT_DEV_URANDOM and MCRYPT_DEV_RANDOM are considered safe.
	 * Using MCRYPT_RAND will silently revert to MCRYPT_DEV_URANDOM arshid
	 */
	protected static $_rand = 'MCRYPT_DEV_URANDOM';

	/**
	 * @var string Encryption key
	 */
	protected $_key;

	/**
	 * @var string mcrypt mode
	 */
	protected $_mode;

	/**
	 * @var string mcrypt cipher
	 */
	protected $_cipher;

	/**
	 * @var int the size of the Initialization Vector (IV) in bytes
	 */
	protected $_iv_size;
	
	/**
	 * Returns a singleton instance of Encrypt. An encryption key must be
	 * provided in your "encrypt" configuration file.
	 *
	 *     $encrypt = Encrypt::instance();
	 *
	 * @param   string  $name   configuration group name
	 * @return  Encrypt
	 */
	public static function instance($name = NULL)
	{
		if ($name === NULL)
		{
			// Use the default instance name
			$name = Encrypt::$default;
		}

		if ( ! isset(Encrypt::$instances[$name]))
		{
			// Load the configuration data
			$config = Kohana::$config->load('encrypt')->$name;

			if ( ! isset($config['key']))
			{
				// No default encryption key is provided!
				throw new Kohana_Exception('No encryption key is defined in the encryption configuration group: :group',
					array(':group' => $name));
			}

			if ( ! isset($config['mode']))
			{
				// Add the default mode
				$config['mode'] = MCRYPT_MODE_NOFB;
			}

			if ( ! isset($config['cipher']))
			{
				// Add the default cipher
				$config['cipher'] = MCRYPT_RIJNDAEL_128;
			}

			// Create a new instance
			Encrypt::$instances[$name] = new Encrypt($config['key'], $config['mode'], $config['cipher']);
		}

		return Encrypt::$instances[$name];
	}

	/**
	 * Creates a new mcrypt wrapper.
	 *
	 * @param   string  $key    encryption key
	 * @param   string  $mode   mcrypt mode
	 * @param   string  $cipher mcrypt cipher
	 */
	public function __construct($key, $mode, $cipher)
	{
		$this->_mode   = $mode;
		$this->_cipher = $cipher;
		$this->_key    = hash('sha256', $key);
		$this->_iv     = substr(hash('sha256', "abc"), 0, 16);
	}

	/**
	 * Encrypts a string and returns an encrypted string that can be decoded.
	 *
	 *     $data = $encrypt->encode($data);
	 *
	 * The encrypted binary data is encoded using [base64](http://php.net/base64_encode)
	 * to convert it to a string. This string can be stored in a database,
	 * displayed, and passed using most other means without corruption.
	 *
	 * @param   string  $data   data to be encrypted
	 * @return  string
	 */
	public function encode($data)
	{
		$output = false;
		
		$output = openssl_encrypt($data, $this->_mode, $this->_key, 0, $this->_iv);
		$output = base64_encode($output);
		
		return $output;
	}

	/**
	 * Decrypts an encoded string back to its original value.
	 *
	 *     $data = $encrypt->decode($data);
	 *
	 * @param   string  $data   encoded string to be decrypted
	 * @return  FALSE   if decryption fails
	 * @return  string
	 */
	public function decode($data)
	{  
		// Convert the data back to binary
		$data = base64_decode($data);

		if ( ! $data)
		{
			// Invalid base64 data
			return FALSE;
		}
		
		$output = openssl_decrypt($data, $this->_mode, $this->_key, 0, $this->_iv);

		// Return the decrypted data, trimming the \0 padding bytes from the end of the data
		return rtrim($output, "\0");
	}

}
