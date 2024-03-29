<?php

namespace App\Lexer;

use App\Token\Token;
use App\Token\TokenType;
use IntlChar;
use NunoMaduro\Collision\Adapters\Phpunit\Printers\DefaultPrinter;

class Lexer
{
	private string $input;
	private int $position;
	private int $read_position;
	private string $ch;

	public function __construct(string $input)
	{
		$this->input = $input;
		$this->read_position = 0;
		$this->read_char();
	}

	public function next_token(): Token
	{
		$tok = new Token();
		switch ($this->ch) {
			case '=':
				$tok = new Token(TokenType::ASSIGN, $this->ch);
				break;
			case ';':
				$tok = new Token(TokenType::SEMICOLON, $this->ch);
				break;
			case '(':
				$tok = new Token(TokenType::LPAREN, $this->ch);
				break;
			case ')':
				$tok = new Token(TokenType::RPAREN, $this->ch);
				break;
			case ',':
				$tok = new Token(TokenType::COMMA, $this->ch);
				break;
			case '+':
				$tok = new Token(TokenType::PLUS, $this->ch);
				break;
			case '{':
				$tok = new Token(TokenType::LBRACE, $this->ch);
				break;
			case '}':
				$tok = new Token(TokenType::RBRACE, $this->ch);
				break;
			case 0:
				$tok = new Token(TokenType::EOF, '');
				break;
			default:
				if (ctype_alpha($this->ch)) {
					$tok->type = TokenType::IDENT;
					$tok->literal = $this->read_identifier();
					return $tok;
				} else {
					$tok = new Token(TokenType::ILLEGAL, $this->ch);
				}
		}

		$this->read_char();
		return $tok;
	}

	private function read_char()
	{
		if ($this->read_position > strlen($this->input)) {
			$this->ch = '';
		} else {
			$this->ch = $this->input[$this->read_position];
		}
		$this->position = $this->read_position;
		$this->read_position += 1;
	}

	private function read_identifier()
	{
		$position = 0;

		while (strlen($this->ch) > $position && $this->ch[$position]) {
			$this->read_char();
		}

		return substr($this->input, $position, $this->position);
	}
}
