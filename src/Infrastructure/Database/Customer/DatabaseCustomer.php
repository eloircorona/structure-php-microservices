<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\Customer;

use App\Application\Settings\SettingsInterface;
use Psr\Container\ContainerInterface;
use App\Domain\Customer\CustomerRepository;
use Illuminate\Database\Connection;

class DatabaseCustomer implements CustomerRepository
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
    
    $customers = $this->database->table('customers')
      ->get()
      ->toArray();

    */

    $users = [
      [ "id" => 0, "name" => "Eloir", "lastname" => "Corona" ]
    ];

    return $users;
  }

}
