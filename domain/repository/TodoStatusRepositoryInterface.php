<?php
namespace CleanTodo\Domain\Repository;

interface TodoStatusRepositoryInterface extends RepositoryInterface
{
    public function getAllTodoStatus();
    public function getReference($id);
    public function getEntity($id);
}
