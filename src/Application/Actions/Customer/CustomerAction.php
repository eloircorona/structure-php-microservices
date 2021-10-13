<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use App\Application\Actions\Action;
use App\Domain\Customer\CustomerRepository;
use Psr\Log\LoggerInterface;

abstract class CustomerAction extends Action
{
  protected $customer_repository;

  public function __construct( LoggerInterface $logger, CustomerRepository $customer_repository ) {
    parent::__construct($logger);
    $this->customer_repository = $customer_repository;
  }
}
