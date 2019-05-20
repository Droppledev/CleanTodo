<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;
use CleanTodo\Domain\Entity\Todo;

class UpdateTodoUseCase
{
    private $todoRepo;
    public function __construct(TodoRepositoryInterface $todoRepo)
    {
        $this->todoRepo = $todoRepo;
    }

    public function update(Todo $todo)
    {
        $this->todoRepo->updateTodo($todo);
    }
}
