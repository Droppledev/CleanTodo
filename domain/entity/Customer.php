<?php

namespace CleanTodo\Domain\Entity;

/**
 * Customer
 *
 */
class Customer extends AbstractEntity
{
    /**
     * @var string
     *
     *
     */
    protected $label;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
}
