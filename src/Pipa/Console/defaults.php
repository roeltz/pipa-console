<?php

namespace Pipa\Console;
use Pipa\Dispatch\ExpressionRouter;
use Pipa\Error\ErrorHandler;
use Pipa\Error\StdoutErrorDisplay;

ErrorHandler::addDisplay(new StdoutErrorDisplay, ConsoleContext::CONTEXT_ID);
ExpressionRouter::registerExpression(new RoutingExpression, ConsoleContext::CONTEXT_ID);
