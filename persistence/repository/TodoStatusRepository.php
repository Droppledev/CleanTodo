<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\TodoStatusRepositoryInterface;

class TodoStatusRepository extends AbstractRepository implements TodoStatusRepositoryInterface
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanTodo\Domain\Entity\TodoStatus';

    public function getAllTodoStatus()
    {
        return $this->getAll();
    }
    public function getReference($id)
    {
        return $this->entityManager->getReference($this->entityClass, $id);
    }
    public function getEntity($id)
    {
        return $this->entityManager->getRepository($this->entityClass)->findOneBy(array('id' => $id));
    }
}
