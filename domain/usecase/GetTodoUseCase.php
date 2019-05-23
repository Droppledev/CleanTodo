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

    public function getAllToJson($user)
    {
        $todos = $this->userRepo->getAllTodoByUserId($user->getId());
        $data = array();
        foreach ($todos as $todo) {
            array_push(
                $data,
                array(
                    'id' => $todo->getId(),
                    'title' => $todo->getTitle(),
                    'detail' => $todo->getDetail()->getDetail(),
                    'priority' => $todo->getPriority()->getPriority(),
                    'status' => $todo->getStatus()->getStatus(),
                    'date_start' => $todo->getDateStart(),
                    'date_end' => $todo->getDateEnd(),
                )
            );
        }
        $json = [
            "status" => "OK",
            "user_id" => $user->getId(),
            "user_name" => $user->getUsername(),
            "todos" => $data
        ];
        return $json;
    }
}
