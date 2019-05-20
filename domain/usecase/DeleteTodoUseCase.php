<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;

class DeleteTodoUseCase
{
    /**
     * @var TodoRepositoryInterface
     */
    private $todoRepo;
    public function __construct(TodoRepositoryInterface $todoRepo)
    {
        $this->todoRepo = $todoRepo;
    }
    public function deleteById($id)
    {
        $this->todoRepo->deleteTodoById($id);
    }
}
