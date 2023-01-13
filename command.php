<?php

$command = $argv;

switch ($command[1]) {
    case 'serve':
        serve($command[2] ?? '127.0.0.1:8000');
        break;

    case 'env':
        env();
        break;

    case 'help':
        help();
        break;

    case 'view:cache':
        clearViewsCache();
        break;

    default:
        exit('Command not found');
}

function serve(string $host): void
{
    exec("php -S $host -t public");
}

function env():void
{
    copy('./.env.example', '.env');
    echo 'env file created';
}

function clearViewsCache(): void
{
    $files = glob('./resources/cache/*.php');

    foreach ($files as $file){
        unlink($file);
    }

    echo "views cache cleared";
}

function help(): void
{
    $document = [
        "help         => show help",
        "serve        => start server | param => ip:port (php command.php serve 127.0.0.1:8000)",
        "env          => build .env (environment variables) file",
        "view:cache   => clear views cache"
    ];

    echo implode(PHP_EOL, $document);
}