<?php

namespace CleanTodo\Domain\Entity;

class TodoStatus extends AbstractEntity
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
