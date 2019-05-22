<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoStatusRepositoryInterface;

class GetTodoStatusUseCase
{
    private $todoStatusRepo;
    public function __construct(TodoStatusRepositoryInterface $todoStatusRepo)
    {
        $this->todoStatusRepo = $todoStatusRepo;
    }
    public function getAll()
    {
        return $this->todoStatusRepo->getAllTodoStatus();
    }
}
