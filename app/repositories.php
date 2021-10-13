<?php
declare(strict_types=1);

use App\Domain\Customer\CustomerRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Database\Customer\DatabaseCustomer;
use App\Infrastructure\Database\User\DatabaseUser;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    
    UserRepository::class => \DI\autowire(DatabaseUser::class),
    CustomerRepository::class => \DI\autowire(DatabaseCustomer::class),

  ]);
};
