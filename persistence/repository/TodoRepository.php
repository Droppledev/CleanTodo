<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;
use CleanTodo\Domain\Entity\Todo;

class TodoRepository extends AbstractRepository implements TodoRepositoryInterface
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanTodo\Domain\Entity\Todo';
    public function getAllTodo()
    {
        return $this->getAll();
    }
    public function getTodoById($id)
    {
        return $this->getById($id);
    }
    public function deleteTodoById($id)
    {
        $this->deleteById($id);
    }
    public function insertTodo(Todo $todo)
    {
        $this->begin()->persist($todo)->commit();
    }
    public function updateTodo(Todo $todo)
    {
        $this->update($todo);
    }
}
