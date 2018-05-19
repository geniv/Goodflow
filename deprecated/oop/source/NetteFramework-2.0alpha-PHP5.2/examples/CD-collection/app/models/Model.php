<?php



/**
 * Model base class.
 */
class Model extends NObject
{
	/** @var NConnection */
	public static $database;


	public static function initialize($options)
	{
		self::$database = new NConnection($options->dsn, $options->user, $options->pass);
	}


	public static function albums()
	{
		return self::$database->table('albums');
	}

}