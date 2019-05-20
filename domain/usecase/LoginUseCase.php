<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\UserRepositoryInterface;
use CleanTodo\Domain\Entity\User;

class LoginUseCase
{
    /** 
     * @var UserRepositoryInterface userRepo
     * */
    private $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function getUser(string $username, string $password)
    {
        return $this->userRepo->getUser($username, $password);
    }
}
