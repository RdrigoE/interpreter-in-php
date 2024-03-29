<?php

namespace Tests\Lexer;

use App\Lexer\Lexer;
use App\Token\TokenType;

function check_equality($input, $test, $t)
{
	$l = new Lexer($input);

	foreach ($test as [$token, $literal]) {
		$tok = $l->next_token();

		$t->assertSame($tok->type, $token);
		$t->assertSame($tok->literal, $literal);
	}
}

test('next_token', function () {
	$input = '=+(){},;';
	$test = [
		[TokenType::ASSIGN, '='],
		[TokenType::PLUS, '+'],
		[TokenType::LPAREN, '('],
		[TokenType::RPAREN, ')'],
		[TokenType::LBRACE, '{'],
		[TokenType::RBRACE, '}'],
		[TokenType::COMMA, ','],
		[TokenType::SEMICOLON, ';'],
		[TokenType::EOF, ''],
	];
	check_equality($input, $test, $this);
});

test('next_token_bigger', function () {
	$input = 'let five = 5;
		let ten = 10;
		let add = fn(x, y) {
		x + y;
		};
		let result = add(five, ten);';
	$test = [
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
		[TokenType::FUNCTION, "fn"],
		[TokenType::LPAREN, "["],
		[TokenType::IDENT, "x"],
		[TokenType::COMMA, ","],
		[TokenType::IDENT, "y"],
		[TokenType::RPAREN, "]"],
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
		[TokenType::RPAREN, "]"],
		[TokenType::SEMICOLON, ";"],
		[TokenType::EOF, ""],
	];
	check_equality($input, $test, $this);
});
