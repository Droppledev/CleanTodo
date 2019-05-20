<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;

class GetTodoUseCase
{
    private $todoRepo;
    public function __construct(TodoRepositoryInterface $todoRepo)
    {
        $this->todoRepo = $todoRepo;
    }
    public function getAll()
    {
        return $this->todoRepo->getAllTodo();
    }
    public function getById($id)
    {
        return $this->todoRepo->getTodoById($id);
    }
}
