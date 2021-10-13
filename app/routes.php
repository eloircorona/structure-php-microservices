<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\Customer\ListCustomersAction;
use App\Application\Middleware\TokenMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->options('/{routes:.*}', function (Request $request, Response $response) { return $response; });

  $app->get('/', function (Request $request, Response $response, $service) {
    $response->getBody()->write(
      $_ENV['APP_NAME'] . ' Service - Mode ' . 
      $_ENV['APP_MODE'] . ' v'. 
      $_ENV['APP_VERSION']
    );
    return $response;
  });

  $app->group('/users', function (Group $group) {
    
    $group->get('', ListUsersAction::class);

  });

  $app->group('/customers', function (Group $group) {
    
    $group->get('', ListCustomersAction::class);
    /* eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlciI6ImV4YW1wbGVfdXNlciJ9.kENTzwg3WT6gvr0r_jUXDMpOuPNRWc6V_j30YoMa7vg */

  })->addMiddleware( new TokenMiddleware($app) );

};
