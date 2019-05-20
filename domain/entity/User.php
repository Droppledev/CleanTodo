<?php

namespace CleanTodo\Domain\Entity;

class User extends AbstractEntity
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * @var string
     */
    protected $password;

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    protected $todos;

    public function getTodos()
    {
        return $this->todos;
    }

    public function setTodos($todos)
    {
        $this->todos = $todos;
        return $this;
    }
}
