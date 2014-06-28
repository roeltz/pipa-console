<?php

namespace Pipa\Console;
use Pipa\Dispatch\Request as BaseRequest;

class Request extends BaseRequest {
	
	public $command;
	
	function __construct() {
		global $argv;
		parent::__construct(ConsoleContext::CONTEXT_ID);
		list($this->command, $this->data) = self::parseArgv($argv);
	}

	static function parseArgv($argv) {
		$argv = array_slice($argv, array_search($_SERVER['PHP_SELF'], $argv) + 1);
		$command = "";
		$data = array();
		foreach($argv as $arg) {
			if (preg_match('/^-([\w-]+)$/', $arg, $m)) {
				foreach(str_split($m[1]) as $flag)
					$data[$flag] = true;
			} elseif (preg_match('/^--?([\w-]+)$/', $arg, $m))
				$data[$m[1]] = true;
			elseif (preg_match('/^--?([\w-]+)=(.+)$/', $arg, $m))
				$data[$m[1]] = $m[2];
			else
				$command = $arg;
		}
		return array($command, $data);
	}
	
	function getComparableState() {
		return array(
			'context'=>'console',
			'os'=>php_uname(),
			'command'=>$this->command
		);
	}
}
