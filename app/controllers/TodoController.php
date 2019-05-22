<?php

class TodoController extends ControllerBase
{
    private function _getSession()
    {
        if ($this->session->has('auth')) {
            return $this->session->has('auth');
        } else {
            $this->response->redirect("");
            return false;
        }
    }
    public function indexAction()
    {
        $this->_getSession();
        $getTodoUseCase = $this->di['getTodoUseCase'];
        $getTodoPriorityUseCase = $this->di['getTodoPriorityUseCase'];
        $getTodoStatusUseCase = $this->di['getTodoStatusUseCase'];

        $user = $this->session->get('auth');
        $todos = $getTodoUseCase->getAll($user['id']);
        $todo_priorities = $getTodoPriorityUseCase->getAll();
        $todo_statuses = $getTodoStatusUseCase->getAll();

        $this->view->setVar('todos', $todos);
        $this->view->setVar('todoPriorities', $todo_priorities);
        $this->view->setVar('todoStatuses', $todo_statuses);
    }
    public function insertAction()
    {
        $this->_getSession();
        $insertTodoUseCase = $this->di['insertTodoUseCase'];
        $todoPriorityRepo = $this->di['todoPriorityRepository'];
        $todoStatusRepo = $this->di['todoStatusRepository'];
        $userRepo = $this->di['userRepository'];
        if ($this->request->isPost()) {
            $todoEntity = $this->di['todoEntity'];
            $todoDetailEntity = $this->di['todoDetailEntity'];
            $todoEntity->setTitle($this->request->get("title"));
            $todoEntity->setDetail($todoDetailEntity->setDetail($this->request->get("detail")));
            $todoEntity->setUser($userRepo->getReference($this->session->get("auth")['id']));
            $todoEntity->setPriority($todoPriorityRepo->getReference($this->request->get("priority")));
            $todoEntity->setStatus($todoStatusRepo->getReference($this->request->get("status")));
            $todoEntity->setCreatedAt();
            $todoEntity->setDateStart(new \DateTime('@' . strtotime($this->request->get("start-date"))));
            $todoEntity->setDateEnd(new \DateTime('@' . strtotime($this->request->get("end-date"))));
            $insertTodoUseCase->insertTodo($todoEntity);
            $this->flashSession->success("New Todo Added !");
            $this->response->redirect("");
        }
    }
    public function deleteAction()
    {
        $this->_getSession();
        $deleteTodoUseCase = $this->di['deleteTodoUseCase'];

        if ($this->request->isPost()) {
            $id = $this->request->get("id");
            $deleteTodoUseCase->deleteById($id);
            $this->flashSession->success("Todo Deleted !");
            $this->response->redirect("");
        }
    }
    public function updateAction()
    {
        $this->_getSession();
        $updateTodoUseCase = $this->di['updateTodoUseCase'];

        $todoPriorityRepo = $this->di['todoPriorityRepository'];
        $todoStatusRepo = $this->di['todoStatusRepository'];
        $userRepo = $this->di['userRepository'];

        if ($this->request->isPost()) {
            $id = $this->request->get("id");
            $todoEntity = $this->di['todoEntity'];
            $todoEntity->setId($id);
            $todoDetailEntity = $this->di['todoDetailEntity'];
            $todoEntity->setTitle($this->request->get("title"));
            $todoEntity->setDetail($todoDetailEntity->setDetail($this->request->get("detail")));
            $todoEntity->setUser($userRepo->getReference($this->session->get("auth")['id']));
            $todoEntity->setPriority($todoPriorityRepo->getEntity($this->request->get("priority")));
            $todoEntity->setStatus($todoStatusRepo->getEntity($this->request->get("status")));
            $todoEntity->setCreatedAt();
            $todoEntity->setDateStart(new \DateTime('@' . strtotime($this->request->get("start-date"))));
            $todoEntity->setDateEnd(new \DateTime('@' . strtotime($this->request->get("end-date"))));

            $updateTodoUseCase->update($todoEntity);
            $this->flashSession->success("Todo Updated !");
            $this->response->redirect("");
        }
    }
    public function pdfAction()
    {
        $this->_getSession();
        $getTodoUseCase = $this->di['getTodoUseCase'];

        $user = $this->session->get('auth');
        $todos = $getTodoUseCase->getAll($user['id']);

        if ($this->request->isPost()) {
            $generatePdfUseCase = $this->di['generatePdfUseCase'];
            $generatePdfUseCase->generatePdf($todos);
        }
    }
}
