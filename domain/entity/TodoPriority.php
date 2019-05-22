<?php

namespace CleanTodo\Domain\Entity;

class TodoPriority extends AbstractEntity
{
    /**
     * @var string
     */
    protected $priority;

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }
}
