<?php

namespace CleanTodo\Domain\Entity;

class Todo extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    protected $detail;

    public function getDetail()
    {
        return $this->detail;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }
    protected $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    protected $priority;

    public function getpriority()
    {
        return $this->priority;
    }

    public function setpriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    protected $createdAt;

    public function getCreatedAt()
    {
        return $this->createdAt->format('d-m-Y');
    }

    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
        $this->createdAt->setTimestamp(strtotime('now'));
        return $this;
    }
    protected $dateStart;

    public function getDateStart()
    {
        return $this->dateStart->format('d-m-Y');
    }

    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
        return $this;
    }
    protected $dateEnd;

    public function getDateEnd()
    {
        return $this->dateEnd->format('d-m-Y');
    }

    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }
    protected $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
