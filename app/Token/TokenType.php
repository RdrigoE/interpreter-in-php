<?php

namespace App\Token;

enum TokenType: string
{
	case ILLEGAL = "ILLEGAL";
	case EOF     = "EOF";
	// Identifiers + literals
	case IDENT = "IDENT"; // add, foobar, x, y, ...;
	case INT   = "INT"; // 1343456;
	// Delimiters;
	case COMMA     = ",";
	case SEMICOLON = ";";
	case LPAREN    = "(";
	case RPAREN    = ")";
	case LBRACE    = "{";
	case RBRACE    = "}";
	// Keywords;
	case FUNCTION = "FUNCTION";
	case LET      = "LET";
	case TRUE     = "TRUE";
	case FALSE    = "FALSE";
	case IF       = "IF";
	case
	ELSE     = "ELSE";
	case RETURN   = "RETURN";
	// Operators
	case ASSIGN   = "=";
	case PLUS     = "+";
	case MINUS    = "-";
	case BANG     = "!";
	case ASTERISK = "*";
	case SLASH    = "/";
	case LT       = "<";
	case GT       = ">";
	case EQ       = "==";
	case NOT_EQ   = "!=";
}
