<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\UserRepositoryInterface;
use CleanTodo\Domain\Entity\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanTodo\Domain\Entity\User';
    /**
     * @param string $username
     */
    public function findByUsername($username)
    {
        return $this->entityManager->getRepository($this->entityClass)->findBy(array('username' => $username));
    }
    /**
     * @param User $user
     * @return $this
     */
    public function registerUser(User $user)
    {
        $this->begin()->persist($user)->commit();
        return $this;
    }
    /**
     * @param string $username
     * @param string $password
     */
    public function getUser(string $username, string $password)
    {
        return $this->entityManager->getRepository($this->entityClass)->findOneBy(array('username' => $username, 'password' => $password));
    }
}
