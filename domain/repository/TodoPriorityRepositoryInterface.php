<?php
namespace CleanTodo\Domain\Repository;

interface TodoPriorityRepositoryInterface extends RepositoryInterface
{
    public function getAllTodoPriority();
    public function getReference($id);
    public function getEntity($id);
}
