<?php

namespace App\Lexer;

use App\Token\Token;
use App\Token\TokenType;

class Lexer
{
	private string $input;
	private int $position;
	private int $read_position;
	private string $ch;

	/** @var array<string, TokenType> KEYWORDS  */
	const KEYWORDS = [
		'fn' => TokenType::FUNCTION,
		'let' => TokenType::LET
	];

	public function __construct(string $input)
	{
		$this->input = $input;
		$this->read_position = 0;
		$this->read_char();
	}

	public function next_token(): Token
	{
		$tok = new Token();

		$this->skip_whitespace();

		switch ($this->ch)
		{
			case '=':
				$tok = new Token(TokenType::ASSIGN, $this->ch);
				break;
			case '+':
				$tok = new Token(TokenType::PLUS, $this->ch);
				break;
			case '-':
				$tok = new Token(TokenType::MINUS, $this->ch);
				break;
			case '!':
				$tok = new Token(TokenType::BANG, $this->ch);
				break;
			case '/':
				$tok = new Token(TokenType::SLASH, $this->ch);
				break;
			case '*':
				$tok = new Token(TokenType::ASTERISK, $this->ch);
				break;
			case '<':
				$tok = new Token(TokenType::LT, $this->ch);
				break;
			case '>':
				$tok = new Token(TokenType::GT, $this->ch);
				break;
			case ';':
				$tok = new Token(TokenType::SEMICOLON, $this->ch);
				break;
			case ',':
				$tok = new Token(TokenType::COMMA, $this->ch);
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
			case "":
				$tok = new Token(TokenType::EOF, '');
				break;
			default:
				if (ctype_alpha($this->ch))
				{
					$tok->literal = $this->read_identifier();
					$tok->type = $this->lookup_ident($tok->literal);
					return $tok;
				}
				else if (ctype_digit($this->ch))
				{
					$tok->type = TokenType::INT;
					$tok->literal = $this->read_number();
					return $tok;
				}
				else
				{
					$tok = new Token(TokenType::ILLEGAL, $this->ch);
				}
		}


		$this->read_char();
		return $tok;
	}

	private function skip_whitespace(): void
	{
		if (in_array($this->ch, [' ', "\r", "\n", "\t"]))
		{
			$this->read_char();
		}
	}

	private function read_char(): void
	{
		if ($this->read_position >= strlen($this->input))
		{
			$this->ch = '';
		}
		else
		{
			$this->ch = $this->input[$this->read_position];
		}
		$this->position = $this->read_position;
		$this->read_position += 1;
	}

	private function read_number(): string
	{
		$position = $this->position;

		while (ctype_digit($this->ch))
		{
			$this->read_char();
		}

		return substr($this->input, $position, $this->position - $position);
	}

	private function read_identifier(): string
	{
		$position = $this->position;

		while ($this->is_letter($this->ch))
		{
			$this->read_char();
		}

		return substr($this->input, $position, $this->position - $position);
	}

	private function is_letter($string): bool
	{
		return  preg_match("/[a-zA-Z]/", $string);
	}

	private function lookup_ident(string $ident): TokenType
	{
		if (key_exists($ident, self::KEYWORDS))
		{
			return self::KEYWORDS[$ident];
		}

		return TokenType::IDENT;
	}
}
