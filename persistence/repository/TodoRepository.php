<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;

class TodoRepository extends AbstractRepository implements TodoRepositoryInterface
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanTodo\Domain\Entity\Todo';
}
