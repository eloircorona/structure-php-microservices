<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action
{
  protected $user_repository;

  public function __construct( LoggerInterface $logger, UserRepository $user_repository ) {
    parent::__construct($logger);
    $this->user_repository = $user_repository;
  }
}
