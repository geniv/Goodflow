<?php

/**
 * Test: NSession storage.
 *
 * @author     David Grudl
 * @package    Nette\Web
 * @subpackage UnitTests
 */



require dirname(__FILE__) . '/../bootstrap.php';



class MySessionStorage extends NObject implements ISessionStorage
{
	private $path;

	function open($savePath, $sessionName)
	{
		$this->path = $savePath;
	}

	function close()
	{
	}

	function read($id)
	{
		return @file_get_contents("$this->path/sess_$id");
	}

	function write($id, $data)
	{
		return file_put_contents("$this->path/sess_$id", $data);
	}

	function remove($id)
	{
		return @unlink("$this->path/sess_$id");
	}

	function clean($maxlifetime)
	{
		foreach (glob("$this->path/sess_*") as $filename) {
			if (filemtime($filename) + $maxlifetime < time()) {
				unlink($filename);
			}
		}
		return TRUE;
	}
}


$session = new NSession;
$session->setStorage(new MySessionStorage);
$session->start();
