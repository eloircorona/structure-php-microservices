<?php
declare(strict_types=1);

namespace App\Application\Middleware;

use App\Application\Settings\SettingsInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Firebase\JWT\JWT;

class TokenMiddleware implements Middleware
{
  private $app;
  public function __construct($app) {

    $this->app = $app;
    
  }

  public function process(Request $request, RequestHandler $handler): ResponseInterface
  {
    if($request->getHeader('Authorization')) {

      $container = $this->app->getContainer();

      $settings = $container->get(SettingsInterface::class);
      $secret = $settings->get('access')['auth'];

      $token = $request->getHeader('Authorization')[0];
      $token = substr($token, 7);

      $decoded = JWT::decode($token, $secret, array('HS256'));

      if(is_object($decoded)) {
        $request = $request->withAttribute('Token', $token);
        $request = $request->withAttribute('User', $decoded);
      }
      else return $this->print_error('Token not valid.', 401); 

    } else return $this->print_error('Token not provided.', 401); 

    return $handler->handle($request);
  }

  private function print_error(string $message, int $status_code)
  {
    $json = json_encode(array(
      'status_code'  => $status_code,
      'data'        => $message
    ), JSON_PRETTY_PRINT);
    
    $response = new Response();
    $response->getBody()->write($json);

    return $response->withHeader('Content-Type', 'application/json')->withStatus($status_code);
  }
}