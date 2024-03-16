<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Predis\ClientInterface as RedisClient;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        RedisClient::class => function (ContainerInterface $c) {
            $redisSettings = $c->get(SettingsInterface::class)->get('redis');

            $client = new Predis\Client([
                'scheme' => $redisSettings['scheme'],
                'host'   => $redisSettings['host'],
                'port'   => $redisSettings['port'],
            ]);

            return $client;
        },
    ]);
};
