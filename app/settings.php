<?php
declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    SettingsInterface::class => function () {
      return new Settings([
        'displayErrorDetails'       => true,
        'logError'                  => false,
        'logErrorDetails'           => false,
        'logger'                    => [
          'name'                      => 'slim-app',
          'path'                      => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
          'level'                     => Logger::DEBUG,
        ],
        'service'                   => [
          'name'                      => $_ENV['APP_NAME'],
          'mode'                      => $_ENV['APP_MODE'],
          'version'                   => $_ENV['APP_VERSION'],
        ],
        'access'                    => [
          'auth'                       => $_ENV['SECRET_KEY']
        ],
        'database'                  => [
          'driver'                    => $_ENV['DB_CONNECTION'],
          'host'                      => $_ENV['DB_HOST'],
          'database'                  => $_ENV['DB_DATABASE'],
          'username'                  => $_ENV['DB_USERNAME'],
          'password'                  => $_ENV['DB_PASSWORD'],
          'charset'                   => 'utf8mb4',
          'collation'                 => 'utf8mb4_unicode_ci',
          'prefix'                    => '',
        ]
      ]);
    }
  ]);
};
