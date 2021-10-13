<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\User;

use App\Application\Settings\SettingsInterface;
use Psr\Container\ContainerInterface;
use App\Domain\User\UserRepository;
use Illuminate\Database\Connection;

class DatabaseUser implements UserRepository
{
  private $database;
  private $mode;

  public function __construct(Connection $connection, ContainerInterface $container)
  {
    $this->database = $connection;
    $this->mode = $container->get(SettingsInterface::class)->get('service')['mode'];
  }

  public function find_all(): array
  {
    /* 
    
    $users = $this->database->table('users')
      ->get()
      ->toArray();

    */

    $users = [
      [ "id" => 0, "name" => "Eloir", "lastname" => "Corona" ]
    ];

    return $users;
  }

}
