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
        $todos = $getTodoUseCase->getAll();
        $this->view->todos = $todos;
    }
    public function insertAction()
    {
        $this->_getSession();
        $insertTodoUseCase = $this->di['insertTodoUseCase'];
        if ($this->request->isPost()) {
            $todoEntity = $this->di['todoEntity'];
            $todoEntity->setTitle($this->request->get("todo"));
            $insertTodoUseCase->insertTodo($todoEntity);
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
            $this->response->redirect("");
        }
    }
    public function updateAction()
    {
        $this->_getSession();
        $updateTodoUseCase = $this->di['updateTodoUseCase'];

        if ($this->request->isPost()) {
            $id = $this->request->get("id");
            $title = $this->request->get("title");

            $todoEntity = $this->di['todoEntity'];
            $todoEntity->setId($id);
            $todoEntity->setTitle($title);

            $updateTodoUseCase->update($todoEntity);
            $this->flashSession->success("Todo Updated !");
            $this->response->redirect("");
        }
    }
    public function pdfAction()
    {
        $this->_getSession();
        $getTodoUseCase = $this->di['getTodoUseCase'];

        $todos = $getTodoUseCase->getAll();

        if ($this->request->isPost()) {
            $generatePdfUseCase = $this->di['generatePdfUseCase'];
            $generatePdfUseCase->generatePdf($todos);
        }
    }
}
