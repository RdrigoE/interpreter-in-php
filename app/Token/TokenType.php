<?php

namespace App\Token;

enum TokenType: string
{
	case ILLEGAL = "ILLEGAL";
	case EOF = "EOF";
		// Identifiers + literals
	case IDENT = "IDENT"; // add, foobar, x, y, ...;
	case INT = "INT"; // 1343456;
		// Operators;
	case ASSIGN = "=";
	case PLUS = "+";
		// Delimiters;
	case COMMA = ",";
	case SEMICOLON = ";";
	case LPAREN = "(";
	case RPAREN = ")";
	case LBRACE = "{";
	case RBRACE = "}";
		// Keywords;
	case FUNCTION = "FUNCTION";
	case LET = "LET";
}
/** @var array<string, TokenType> KEYWORDS  */
const KEYWORDS = [
	'fn' => TokenType::FUNCTION,
	'let' => TokenType::LET
];

function lookup_ident(string $ident): TokenType
{
	if (key_exists($ident, KEYWORDS)) {
		return KEYWORDS[$ident];
	}

	return TokenType::IDENT;
}
