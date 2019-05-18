<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\CustomerRepositoryInterface;

class CustomerRepository extends AbstractRepository implements CustomerRepositoryInterface
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanTodo\Domain\Entity\Customer';
}
