<?php
namespace CleanTodo\Domain\Repository;

use CleanTodo\Domain\Entity\AbstractEntity;

interface RepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @param AbstractEntity $entity
     * @return $this
     */
    public function persist(AbstractEntity $entity);
    /**
     * @return $this
     */
    public function begin();

    /**
     * @return $this
     */
    public function commit();

    public function deleteById($id);

    public function update(AbstractEntity $entity);
}
