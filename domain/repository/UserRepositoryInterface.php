<?php
namespace CleanTodo\Domain\Repository;

use CleanTodo\Domain\Entity\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByUsername($username);
    public function registerUser(User $user);
    public function getUser(string $username, string $password);
    public function getAllTodoByUserId($id);
    public function getReference($id);
}
