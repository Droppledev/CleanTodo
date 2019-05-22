<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\UserRepositoryInterface;

class GetTodoUseCase
{
    private $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function getAll($id)
    {
        return $this->userRepo->getAllTodoByUserId($id);
    }
}
