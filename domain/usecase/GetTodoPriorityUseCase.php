<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoPriorityRepositoryInterface;

class GetTodoPriorityUseCase
{
    private $todoPriorityRepo;
    public function __construct(TodoPriorityRepositoryInterface $todoPriorityRepo)
    {
        $this->todoPriorityRepo = $todoPriorityRepo;
    }
    public function getAll()
    {
        return $this->todoPriorityRepo->getAllTodoPriority();
    }
}
