<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\TodoPriorityRepositoryInterface;

class TodoPriorityRepository extends AbstractRepository implements TodoPriorityRepositoryInterface
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanTodo\Domain\Entity\TodoPriority';

    public function getAllTodoPriority()
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
