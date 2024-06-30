<?php

namespace App\Ast;

use App\Token\Token;
use App\Token\TokenType;

interface Node
{
	public function token_literal(): string;
}

interface Statement extends Node
{
	public function statement_node();
}

interface Expression extends Node
{
	public function expression_node();
}

class Identifier implements Expression
{
	public Token $token;
	public string $value;

	public function expression_node()
	{
	}
	public function token_literal(): string
	{
		return $this->token->literal;
	}

}
class LetStatement implements Statement
{
	public Token $token;
	public Identifier $name;
	public Expression $value;


	public function statement_node()
	{
	}
	public function token_literal(): string
	{
		return $this->token->literal;
	}
}

class Program
{
	/** @var array{Statement} */
	public array $statements;

	public function token_literal()
	{

		if (count($this->statements) > 0)
		{
			return $this->statements[0]->token_literal();
		}
		else
		{
			return "";
		}
	}
}

class Ast
{

}