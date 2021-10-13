<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;

class ListCustomersAction extends CustomerAction
{
  protected function action(): Response
  {
    
    $token = $this->request->getAttribute('Token');
    $user = $this->request->getAttribute('User'); 
    
    $users = $this->customer_repository->find_all();

    $this->logger->info("Customer list was viewed by " . $user->user . '.');

    return $this->respondWithData($users);
  }
}
