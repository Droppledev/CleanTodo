<?php
namespace CleanTodo\Domain\UseCase;

use CleanTodo\Domain\Repository\UserRepositoryInterface;
use CleanTodo\Domain\Entity\User;

class RegisterUseCase
{
    /** 
     * @var UserRepositoryInterface userRepo
     * */
    private $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function register(User $user)
    {
        $this->userRepo->registerUser($user);
    }
    public function isUserExist($username)
    {
        $user = $this->userRepo->findByUsername($username);
        if ($user) {
            return true;
        }
        return false;
    }
}
