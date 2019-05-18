<?php
namespace CleanTodo\Persistence\Repository;

use CleanTodo\Domain\Repository\RepositoryInterface;
use CleanTodo\Domain\Entity\AbstractEntity;
use Doctrine\ORM\EntityManager;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        if (empty($this->entityClass)) {
            throw new \RuntimeException(
                get_class($this) . '::$entityClass is not defined'
            );
        }

        $this->entityManager = $em;
    }
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $entityClass;
    /**
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->entityManager->find($this->entityClass, $id);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->entityManager->getRepository($this->entityClass)->findAll();
    }

    /**
     * @param AbstractEntity $entity
     * @return $this
     */
    public function persist(AbstractEntity $entity)
    {
        $this->entityManager->persist($entity);
        return $this;
    }
    /**
     * @return $this
     */
    public function begin()
    {
        $this->entityManager->beginTransaction();
        return $this;
    }

    /**
     * @return $this
     */
    public function commit()
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
        return $this;
    }
    public function deleteById($id)
    {
        $entity = $this->entityManager->getReference($this->entityClass, $id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function update(AbstractEntity $entity)
    {
        $data = $this->entityManager->merge($entity);
        $this->entityManager->flush();
    }
}
