<?php

/**
 * Common code for NTemplate test cases.
 */



// Setup caching storage

class MockCacheStorage extends NTemplateCacheStorage
{

	public function write($key, $data, array $dp)
	{
		file_put_contents(dirname(__FILE__) . '/compiled/' . trim(str_replace(DIRECTORY_SEPARATOR, '.', $this->hint), '.') . '.php', preg_replace('#[a-f0-9]{10,}#', '...', $data));
		return parent::write($key, $data, $dp);
	}

}



class MockTemplate extends NTemplate
{
	public $compiled;

	public function render($content = NULL)
	{
		$this->__set('template', $this);
		$this->compiled = $this->compile($content);
		ob_start();
		NLimitedScope::evaluate($this->compiled, $this->getParams());
		return ob_get_clean();
	}

}
