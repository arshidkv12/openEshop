<?php
/**
 * ����һ���������� GETTEXT �� POT �ļ����� - This class can help you to create a POT file for GETTEXT
 * @author	Hpyer <coolhpy@163.com>
 * @version	1.0
 * @link	http://hpyer.cn/codes/potcreator
 * @license	MIT License <http://www.opensource.org/licenses/mit-license.php>
 */
class POTCreator {
	/**
	 * Ҫ�����ĸ�Ŀ¼ - The root directory that will be searched
	 * @access	private
	 * @var		string
	 */
	private $root;
	
	/**
	 * ��������չ���������չ���ùܵ��� | �ָ� - Allowed extensions, split multi extensions with |
	 * @access	private
	 * @var		string
	 */
	private $exts;
	
	/**
	 * �Ƿ��ȡ��Ŀ¼ - Whether read sub directories
	 * @access	private
	 * @var		boolean
	 */
	private $read_subdir;
	
	/**
	 * ��������λ�õ��������õĸ�Ŀ¼�����·�� - Relative path from language file to the root path you set
	 * @access	private
	 * @var		string
	 */
	private $base_path;
	
	/**
	 * ��ȡ��Ϣ���������ʽ - The regular expression for extract messages
	 * @access	private
	 * @var		string
	 */
	private $regular;
	
	/**
	 * ��ʼ�����ֲ��� - Reset all parameter
	 * @access	public
	 * @var		string
	 */
	public function __construct() {
		$this->root = '.';
		$this->exts = 'php';
		$this->base_path = '';
		$this->read_subdir = true;
		$this->regular = "/_[_|e]\([\"|\']([^\"|\']+)[\"|\']\)/i";
	}
	
	/**
	 * ���� root - SETTER for root
	 * @access	public
	 * @param	string	$root	��������չ���������չ���ùܵ��� | �ָ� - Allowed extensions, split multi extensions with |
	 * @return	void
	 */
	public function set_root($root) {
		if (file_exists($root)) $this->root = str_replace('\\', '/', $root);
	}
	
	/**
	 * ���� exts - SETTER for exts
	 * @access	public
	 * @param	string	$exts	��������չ���������չ���ùܵ��� | �ָ� - Allowed extensions, split multi extensions with |
	 * @return	void
	 */
	public function set_exts($exts) {
		if (is_string($exts)) $this->exts = $exts;
	}
	
	/**
	 * ���� regular - SETTER for regular
	 * @access	public
	 * @param	string	$regular	��ȡ��Ϣ���������ʽ - The regular expression for extract messages
	 * @return	void
	 */
	public function set_regular($regular) {
		if (is_string($regular)) $this->regular = $regular;
	}
	
	/**
	 * ���� base_path - SETTER for base_path
	 * @access	public
	 * @param	string	$base_path	��������λ�õ��������õĸ�Ŀ¼�����·�� - Relative path from language file to the root path you set
	 * @return	void
	 */
	public function set_base_path($base_path) {
		if (is_string($base_path)) $this->base_path = $base_path;
	}
	
	/**
	 * ���� read_subdir - SETTER for read_subdir
	 * @access	public
	 * @param	boolean	$read_subdir	����Ϊ true ��ʾ��ȡ��Ŀ¼ - Set true means it will read sub directories
	 * @return	void
	 */
	public function set_read_subdir($read_subdir) {
		$this->read_subdir = $read_subdir ? true : false;
	}
	
	/**
	 * ��ȡ��Ϣ����POT�ļ���ʽд���ļ� - Read messages and write into file
	 * @access	public
	 * @param	string	$filename	�ļ��� - Filename
	 * @return	void
	 */
	public function write_pot($filename) {
		file_put_contents($filename, $this->get_pot());
	}
	
	/**
	 * ��ȡ��Ϣ����POT�ļ���ʽ������� - Read messages and output the content like POT file
	 * @access	public
	 * @return	string
	 */
	public function get_pot() {
		$files = $this->read_dir($this->root);
		$msgs = $this->file2msg($files);
		return $this->msg2pot($msgs);
	}
	
	/**
	 * ��Ϣת��POT�ļ� - Make messages to POT file
	 * @access	private
	 * @param	array	$msgs	��Ϣ�б� - Message list
	 * @return	string
	 */
	private function msg2pot($msgs) {
		$pot = 'msgid ""
msgstr ""
"Project-Id-Version: OfficeGate Language Pack\n"
"POT-Creation-Date: ' . date('Y-m-d H:iO') . '\n"
"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\n"
"Last-Translator: FULL NAME <EMAIL@ADDRESS>\n"
"Language-Team: LANGUAGE <LL@li.org>\n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"X-Poedit-Basepath: ' . $this->base_path . '\n"
';
		foreach ($msgs as $msgid => $files) {
			$pot .= "\n";
			foreach ($files as $file) {
				$pot .= $file . "\n";
			}
			$pot .= 'msgid "' . $msgid . "\"\n";
			$pot .= "msgstr \"\"\n";
		}
		return $pot;
	}
	
	/**
	 * ��ȡ�ļ��е���Ϣ - Extract messages from files
	 * @access	private
	 * @param	array	$files	�ļ��б� - File list
	 * @return	array
	 */
	private function file2msg($files) {
		$msgs = array();
		$fileline = '';
		$msgid = '';
		foreach ($files as $file) {
			$lines = file($this->root . '/' . $file);
			foreach ($lines as $line_num => $line) {
				$fileline = "#: $file:" . ($line_num + 1);
				$matches = array();
				if (preg_match_all($this->regular, $line, $matches)) {
					for ($i=0,$c=count($matches[1]); $i<$c; $i++) {
						$msgid = $matches[1][$i];
						if (!array_key_exists($msgid, $msgs) || !in_array($fileline, $msgs[$msgid])) $msgs[$msgid][] = $fileline;
					}
				}
			}
		}
		return $msgs;
	}
	
	/**
	 * ������������չ�����������ļ� - Get files with allowed extensions
	 * @access	private
	 * @param	string	$root	��ȡ��Ŀ¼ - Directory to read
	 * @param	string	$parent	�ϼ�Ŀ¼������Ĭ��ֵ - Parent directory, keep default value
	 * @return	array
	 */
	private function read_dir($root, $parent='.') {
		$files = array();
		$abs_file = '';
		$rel_file = '';
		if ($dh = opendir($root)) {
			while (($file = readdir($dh)) !== false) {
				if ($file == '.' || $file == '..') continue;
				$abs_file = $root . '/' . $file;
				$rel_file = $parent . '/' . $file;
				if (is_file($abs_file) && preg_match('/.+\.(' . $this->exts . ')$/i', $file)) {
					$files[] = ltrim($rel_file, './');
				} else {
					// �����ȡ��Ŀ¼ - If read sub directories
					if (is_dir($abs_file) && $this->read_subdir) {
						$files = array_merge($files, $this->read_dir($abs_file, $rel_file));
					}
				}
			}
			closedir($dh);
		}
		return $files;
	}
}

?>