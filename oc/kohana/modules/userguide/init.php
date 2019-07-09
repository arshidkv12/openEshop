<?php

// Static file serving (CSS, JS, images)
Route::set('docs/media', 'guide-media(/<file>)', ['file' => '.+'])
	->defaults([
		'controller' => 'Userguide',
		'action'     => 'media',
		'file'       => NULL,
	]);

// API Browser, if enabled
if (Kohana::$config->load('userguide.api_browser') === TRUE)
{
	Route::set('docs/api', 'guide-api(/<class>)', ['class' => '[a-zA-Z0-9_]+'])
		->defaults([
			'controller' => 'Userguide',
			'action'     => 'api',
			'class'      => NULL,
		]);
}

// User guide pages, in modules
Route::set('docs/guide', 'guide(/<module>(/<page>))', [
		'page' => '.+',
	])
	->defaults([
		'controller' => 'Userguide',
		'action'     => 'docs',
		'module'     => '',
	]);

// Simple autoloader used to encourage PHPUnit to behave itself.
class Markdown_Autoloader {
	public static function autoload($class)
	{
		if ($class == 'Markdown_Parser' OR $class == 'MarkdownExtra_Parser')
		{
			include_once Kohana::find_file('vendor', 'markdown/markdown');
		}
	}
}

// Register the autoloader
spl_autoload_register(['Markdown_Autoloader', 'autoload']);
