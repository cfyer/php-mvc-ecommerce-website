<?php

require './vendor/autoload.php';

use Cfyer\ColorizeCli\CliColor;

$command = $argv;

isset($command[1]) ?: $command[1] = 'help';

$function = match ($command[1]) {
	'serve' => serve($command[2] ?? '127.0.0.1:8000'),
	'env' => env(),
	'help' => help(),
	'view:cache' => clearViewsCache(),
	default => def()
};

function serve(string $host): void
{
	exec("php -S $host -t public");
}

function env(): void
{
	copy('./.env.example', '.env');
	tag('INFO');
	echo CliColor::paint('env file created', 'green');
}

function clearViewsCache(): void
{
	$files = glob('./resources/cache/*.php');

	foreach ($files as $file) {
		unlink($file);
	}

	tag('INFO');
	echo CliColor::paint('views cache cleared', 'green');
}

function help(): void
{
	echo CliColor::bold('cyan');

	$document = [
		"help         => show help",
		"serve        => start server | param => ip:port (php command.php serve 127.0.0.1:8000)",
		"env          => build .env (environment variables) file",
		"view:cache   => clear views cache"
	];

	echo implode(PHP_EOL, $document) . CliColor::RESET;
}

function tag(string $text, string $bg = 'blue'): void
{
	echo CliColor::bg($bg) . CliColor::pad($text, '2') . CliColor::RESET;
}

function def(): void{
	tag('ERROR', 'red');
	echo CliColor::paint('Command not found', 'red', 'ul');
}