<?php
declare(strict_types=1);

namespace App\Domain\Customer;

interface CustomerRepository
{
  public function find_all(): array;
}
