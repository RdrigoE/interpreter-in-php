<?php

namespace App\Main;

use App\Lexer\Lexer;
use App\Token\TokenType;

const PROMP = '>>';

class REPL
{
	public static function start(): void
	{
		while (true)
		{
			echo (PROMP);
			$input = fgets(STDIN);

			if (empty($input))
			{
				return;
			}

			$lexer = new Lexer($input);

			while ($token = $lexer->next_token())
			{
				if ($token->type == TokenType::EOF)
				{
					break;
				}
				echo ($token);
			}
			echo ("\n");
		}
	}
}