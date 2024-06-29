<?php

namespace Tests\Lexer;

use App\Lexer\Lexer;
use App\Token\TokenType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LexerTest extends TestCase
{
	/**
	 * @param string $input
	 * @param array<array{TokenType, string}> $test
	 * @return void
	 *
	 */
    #[DataProvider('lexerProvider')]
	public function testLexer(string $input, array $test): void
	{
		$l = new Lexer($input);

		foreach ($test as [$token, $literal])
		{
			$tok = $l->next_token();

			$this->assertSame($token, $tok->type);
			$this->assertSame($literal, $tok->literal);
		}
	}

	public static function lexerProvider(): array
	{
		return [
			[
				'=+(){},;',
				[
					[TokenType::ASSIGN, '='],
					[TokenType::PLUS, '+'],
					[TokenType::LPAREN, '('],
					[TokenType::RPAREN, ')'],
					[TokenType::LBRACE, '{'],
					[TokenType::RBRACE, '}'],
					[TokenType::COMMA, ','],
					[TokenType::SEMICOLON, ';'],
					[TokenType::EOF, ""],
				],
			],
			[
				'let five = 5; let ten = 10; let add = fn(x, y) { x + y; }; let result = add(five, ten);',
				[
					[TokenType::LET, "let"],
					[TokenType::IDENT, "five"],
					[TokenType::ASSIGN, "="],
					[TokenType::INT, "5"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::LET, "let"],
					[TokenType::IDENT, "ten"],
					[TokenType::ASSIGN, "="],
					[TokenType::INT, "10"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::LET, "let"],
					[TokenType::IDENT, "add"],
					[TokenType::ASSIGN, "="],
					[TokenType::FUNCTION , "fn"],
					[TokenType::LPAREN, "("],
					[TokenType::IDENT, "x"],
					[TokenType::COMMA, ","],
					[TokenType::IDENT, "y"],
					[TokenType::RPAREN, ")"],
					[TokenType::LBRACE, "{"],
					[TokenType::IDENT, "x"],
					[TokenType::PLUS, "+"],
					[TokenType::IDENT, "y"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::RBRACE, "}"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::LET, "let"],
					[TokenType::IDENT, "result"],
					[TokenType::ASSIGN, "="],
					[TokenType::IDENT, "add"],
					[TokenType::LPAREN, "("],
					[TokenType::IDENT, "five"],
					[TokenType::COMMA, ","],
					[TokenType::IDENT, "ten"],
					[TokenType::RPAREN, ")"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::EOF, ""],
				],
			],
			[
				"let five = 5; let ten = 10; let add = fn(x, y) { x + y; }; let result = add(five, ten); !-/*5; 5 < 10 > 5;",
				[
					[TokenType::LET, "let"],
					[TokenType::IDENT, "five"],
					[TokenType::ASSIGN, "="],
					[TokenType::INT, "5"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::LET, "let"],
					[TokenType::IDENT, "ten"],
					[TokenType::ASSIGN, "="],
					[TokenType::INT, "10"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::LET, "let"],
					[TokenType::IDENT, "add"],
					[TokenType::ASSIGN, "="],
					[TokenType::FUNCTION , "fn"],
					[TokenType::LPAREN, "("],
					[TokenType::IDENT, "x"],
					[TokenType::COMMA, ","],
					[TokenType::IDENT, "y"],
					[TokenType::RPAREN, ")"],
					[TokenType::LBRACE, "{"],
					[TokenType::IDENT, "x"],
					[TokenType::PLUS, "+"],
					[TokenType::IDENT, "y"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::RBRACE, "}"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::LET, "let"],
					[TokenType::IDENT, "result"],
					[TokenType::ASSIGN, "="],
					[TokenType::IDENT, "add"],
					[TokenType::LPAREN, "("],
					[TokenType::IDENT, "five"],
					[TokenType::COMMA, ","],
					[TokenType::IDENT, "ten"],
					[TokenType::RPAREN, ")"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::BANG, "!"],
					[TokenType::MINUS, "-"],
					[TokenType::SLASH, "/"],
					[TokenType::ASTERISK, "*"],
					[TokenType::INT, "5"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::INT, "5"],
					[TokenType::LT, "<"],
					[TokenType::INT, "10"],
					[TokenType::GT, ">"],
					[TokenType::INT, "5"],
					[TokenType::SEMICOLON, ";"],
					[TokenType::EOF, ""],
				],
				[
					"let five = 5; let ten = 10; let add = fn(x, y) { x + y; }; let result = add(five, ten); !-/*5; 5 < 10 > 5;",
					[
						[TokenType::LET, "let"],
						[TokenType::IDENT, "five"],
						[TokenType::ASSIGN, "="],
						[TokenType::INT, "5"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::LET, "let"],
						[TokenType::IDENT, "ten"],
						[TokenType::ASSIGN, "="],
						[TokenType::INT, "10"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::LET, "let"],
						[TokenType::IDENT, "add"],
						[TokenType::ASSIGN, "="],
						[TokenType::FUNCTION , "fn"],
						[TokenType::LPAREN, "("],
						[TokenType::IDENT, "x"],
						[TokenType::COMMA, ","],
						[TokenType::IDENT, "y"],
						[TokenType::RPAREN, ")"],
						[TokenType::LBRACE, "{"],
						[TokenType::IDENT, "x"],
						[TokenType::PLUS, "+"],
						[TokenType::IDENT, "y"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::RBRACE, "}"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::LET, "let"],
						[TokenType::IDENT, "result"],
						[TokenType::ASSIGN, "="],
						[TokenType::IDENT, "add"],
						[TokenType::LPAREN, "("],
						[TokenType::IDENT, "five"],
						[TokenType::COMMA, ","],
						[TokenType::IDENT, "ten"],
						[TokenType::RPAREN, ")"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::BANG, "!"],
						[TokenType::MINUS, "-"],
						[TokenType::SLASH, "/"],
						[TokenType::ASTERISK, "*"],
						[TokenType::INT, "5"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::INT, "5"],
						[TokenType::LT, "<"],
						[TokenType::INT, "10"],
						[TokenType::GT, ">"],
						[TokenType::INT, "5"],
						[TokenType::SEMICOLON, ";"],
						[TokenType::EOF, ""],
					]
				]
			]
		];
	}
}