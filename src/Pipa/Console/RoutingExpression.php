<?php

namespace Pipa\Console;
use Pipa\Matcher\Expression;
use Pipa\Matcher\Pattern;
use Pipa\Parser\Match as ParserMatch;
use Pipa\Parser\Symbol\Regex;
use Pipa\Parser\Symbol\NonTerminal;
use Pipa\Parser\Symbol\Quantified\ZeroOrOne;

class RoutingExpression extends Expression {
	
	function __construct() {
		parent::__construct(array(
			'command'=>new Regex('\S*'),
			'os'=>new ZeroOrOne(new NonTerminal(array(
				'sigil'=>new Regex('\s+#'),
				'content'=>new Regex('\S+'),
			)))
		));
	}
	
	function toPattern(ParserMatch $match) {
		$os = @$match->value['os']->value['content']->value;
		$command = $match->value['command']->value;

		if ($os) {
			$os = array('regex'=>"/$os/");
		} else {
			$os = array('any'=>true);
		}

		return new Pattern(array(
			'request:os'=>$os,
			'request:command'=>array('capture'=>$command)
		));
	}
}
