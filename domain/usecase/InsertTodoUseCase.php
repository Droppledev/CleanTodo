<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;
use CleanTodo\Domain\Entity\Todo;

class InsertTodoUseCase
{
    private $todoRepo;
    public function __construct(TodoRepositoryInterface $todoRepo)
    {
        $this->todoRepo = $todoRepo;
    }
    public function insertTodo(Todo $todo)
    {
        $this->todoRepo->insertTodo($todo);
    }
}
