<?php
use App\Ast\Program;
use App\Lexer\Lexer;
use App\Token\Token;

class Parser
{
	public Lexer $lexer;
	public Token $cur_token;
	public Token $peek_token;

	public function __construct(Lexer $lexer)
	{
		$this->lexer = $lexer;

		$this->next_token();
		$this->next_token();
	}

	public function next_token()
	{
		$this->cur_token  = $this->peek_token;
		$this->peek_token = $this->lexer->next_token();
	}

	public function parse_program(): Program
	{
		return new Program;
	}
}