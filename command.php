<?php

$command = $argv;

switch ($command[1]) {
    case 'serve':
        serve($command[2] ?? '127.0.0.1:8000');
        break;

    case 'help':
        help();
        break;

    default:
        exit('Command not found');
}

function serve(string $host): void
{
    exec("php -S $host -t public");
}

function help(): void
{
    $document = [
        "help   => show help",
        "serve  => start server | param => ip:port (127.0.0.1:8000)",
    ];

    echo implode(PHP_EOL, $document);
}