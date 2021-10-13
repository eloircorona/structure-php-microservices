<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;

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
  ]);

  $containerBuilder->addDefinitions([
    Connection::class => function (ContainerInterface $container) {
      $settings = $container->get(SettingsInterface::class);

      $factory = new ConnectionFactory(new IlluminateContainer());

      $connection = $factory->make($settings->get('database'));
      $connection->disableQueryLog();

      return $connection;
    },

    PDO::class => function (ContainerInterface $container) { return $container->get(Connection::class)->getPdo(); },
  ]);

};
