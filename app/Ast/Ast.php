<?php

namespace App\Ast;
use App\Token\Token;
use PhpParser\Node\Identifier;

interface Node
{
	public function token_literal(): string;
}

interface Statement extends Node
{
	public function statement_node(): void;
}

interface Expression extends Node
{
	public function expression_node(): void;
}

class Identifier
{
	public TokenType $token;
	public string $value;
}
class LetStatement
{
	public Token $token;
	public Identifier $name;
	public Token $token;
}
type LetStatement struct {
Token token.Token // the token.LET token
Name *Identifier
Value Expression
}
func (ls *LetStatement) statementNode() {}
func (ls *LetStatement) TokenLiteral() string { return ls.Token.Literal }
type Identifier struct {
Token token.Token // the token.IDENT token
Value string
}
func (i *Identifier) expressionNode() {}
func (i *Identifier) TokenLiteral() string { return i.Token.Literal }

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