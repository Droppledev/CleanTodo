<?php

namespace CleanTodo\Domain\Entity;

class TodoDetail extends AbstractEntity
{
    /**
     * @var string
     */
    protected $detail;

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     * @return $this
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }
}
