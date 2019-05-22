<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\TodoRepositoryInterface;
use CleanTodo\Domain\Entity\Todo;
use CleanTodo\Domain\Repository\UserRepositoryInterface;
use CleanTodo\Domain\Repository\TodoStatusRepositoryInterface;
use CleanTodo\Domain\Repository\TodoPriorityRepositoryInterface;
use CleanTodo\Domain\Entity\TodoDetail;

class RequestTodoUseCase
{
    private $todoRepo;
    public function __construct(
        TodoRepositoryInterface $todoRepo,
        UserRepositoryInterface $userRepo,
        TodoStatusRepositoryInterface $todoStatusRepo,
        TodoPriorityRepositoryInterface $todoPriorityRepo
    ) {
        $this->todoRepo = $todoRepo;
        $this->userRepo = $userRepo;
        $this->todoStatusRepo = $todoStatusRepo;
        $this->todoPriorityRepo = $todoPriorityRepo;
    }

    public function preInsert(Todo $todo, TodoDetail $todoDetail, $title, $detail, $userId, $priority, $status, $dateStart, $dateEnd)
    {
        $todo->setTitle($title);
        $todo->setDetail($todoDetail->setDetail($detail));
        $todo->setUser($this->userRepo->getReference($userId));
        $todo->setPriority($this->todoPriorityRepo->getReference($priority));
        $todo->setStatus($this->todoStatusRepo->getReference($status));
        $todo->setCreatedAt();
        $todo->setDateStart(new \DateTime('@' . strtotime($dateStart)));
        $todo->setDateEnd(new \DateTime('@' . strtotime($dateEnd)));
        return $todo;
    }
    public function preUpdate(Todo $todo, TodoDetail $todoDetail, $id, $title, $detail, $userId, $priority, $status, $dateStart, $dateEnd)
    {
        $todo->setId($id);
        $todo->setTitle($title);
        $todo->setDetail($todoDetail->setDetail($detail));
        $todo->setUser($this->userRepo->getReference($userId));
        $todo->setPriority($this->todoPriorityRepo->getEntity($priority));
        $todo->setStatus($this->todoStatusRepo->getEntity($status));
        $todo->setCreatedAt();
        $todo->setDateStart(new \DateTime('@' . strtotime($dateStart)));
        $todo->setDateEnd(new \DateTime('@' . strtotime($dateEnd)));
        return $todo;
    }
}
