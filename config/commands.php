<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Container;
use App\Commands\UserCommand;
use App\Commands\EncryptCommand;

Dotenv::createImmutable(__DIR__ . '/../')->load();
$container = Container::init();
$app = new Silly\Application();

$app->useContainer($container, $injectWithTypeHint = true);

## Commands here ##

$app->command('database:users value', UserCommand::class);
$app->command('openssl:keys operation', EncryptCommand::class);

## EOF Commands ##

$app->run();