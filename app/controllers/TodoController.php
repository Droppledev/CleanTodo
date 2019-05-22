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
    public function todayfutureAction()
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
        $requestTodoUseCase = $this->di['requestTodoUseCase'];

        if ($this->request->isPost()) {
            $todoEntity = $this->di['todoEntity'];
            $todoDetailEntity = $this->di['todoDetailEntity'];

            $todoTitle = $this->request->get("title");
            $todoDetail = $this->request->get("detail");
            $todoUser = $this->session->get("auth")['id'];
            $todoPriority = $this->request->get("priority");
            $todoStatus = $this->request->get("status");
            $todoStartDate = $this->request->get("start-date");
            $todoEndDate = $this->request->get("end-date");

            if ($todoStartDate > $todoEndDate) {
                $this->flashSession->error("Start date can't be greater than end date !");
                $this->response->redirect("");
                return;
            }

            $todoEntity = $requestTodoUseCase->preInsert($todoEntity, $todoDetailEntity, $todoTitle, $todoDetail, $todoUser, $todoPriority, $todoStatus, $todoStartDate, $todoEndDate);
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
        $requestTodoUseCase = $this->di['requestTodoUseCase'];

        if ($this->request->isPost()) {
            $todoEntity = $this->di['todoEntity'];
            $todoDetailEntity = $this->di['todoDetailEntity'];

            $todoId = $this->request->get("id");
            $todoTitle = $this->request->get("title");
            $todoDetail = $this->request->get("detail");
            $todoUser = $this->session->get("auth")['id'];
            $todoPriority = $this->request->get("priority");
            $todoStatus = $this->request->get("status");
            $todoStartDate = $this->request->get("start-date");
            $todoEndDate = $this->request->get("end-date");

            if ($todoStartDate > $todoEndDate) {
                $this->flashSession->error("Start date can't be greater than end date !");
                $this->response->redirect("");
                return;
            }

            $todoEntity = $requestTodoUseCase->preUpdate($todoEntity, $todoDetailEntity, $todoId, $todoTitle, $todoDetail, $todoUser, $todoPriority, $todoStatus, $todoStartDate, $todoEndDate);
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
