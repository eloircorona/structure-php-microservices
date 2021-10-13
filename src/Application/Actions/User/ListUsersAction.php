<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class ListUsersAction extends UserAction
{
  protected function action(): Response
  {
    /* 
      $token = $this->request->getAttribute('Token');
      $user = $this->request->getAttribute('User'); 
    */
    
    $users = $this->user_repository->find_all();

    $this->logger->info("Users list was viewed.");

    return $this->respondWithData($users);
  }
}
