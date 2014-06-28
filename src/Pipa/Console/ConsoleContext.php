<?php

namespace Pipa\Console;
use Pipa\Dispatch\Context;
use Pipa\Dispatch\Dispatch;
use Pipa\Dispatch\Response;
use Pipa\Error\ErrorHandler;

class ConsoleContext extends Context {
	
	const CONTEXT_ID = 'console';
	
	function dispatch(Router $router) {
		ErrorHandler::setContext(self::CONTEXT_ID);
		
		$dispatch = new Dispatch(
			$this,
			$router,
			new Request,
			new Response
		);
		
		return $dispatch->run();
	}
}
