<?php
namespace CleanTodo\Domain\Repository;

use CleanTodo\Domain\Entity\Todo;

interface TodoRepositoryInterface extends RepositoryInterface
{
    public function getAllTodo();
    public function getTodoById($id);
    public function deleteTodoById($id);
    public function insertTodo(Todo $todo);
    public function updateTodo(Todo $todo);
}
