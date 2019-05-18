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
        return $this->todoRepo->getAll();
    }
    public function getById($id)
    {
        return $this->todoRepo->getById($id);
    }
}
