<?php

namespace App\Token;


/** @package Token */
class Token
{
	public TokenType $type;
	public string $literal;

	public function __construct(TokenType $type = null, string $literal = null)
	{
		if (! ($type && isset($literal)))
		{
			return;
		}
		$this->type    = $type;
		$this->literal = $literal;
	}

	public function __tostring(): string
	{
		return "$this->type ($this->literal)";

	}
}
