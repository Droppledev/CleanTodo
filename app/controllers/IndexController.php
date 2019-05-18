<?php

class IndexController extends ControllerBase
{
	public function indexAction()
	{
		$getTodoUseCase = $this->di['getTodoUseCase'];

		$todos = $getTodoUseCase->getAll();
		$this->view->todos = $todos;
	}
	public function insertAction()
	{
		$insertTodoUseCase = $this->di['insertTodoUseCase'];
		$request = $this->di['request'];
		$response = $this->di['response'];

		if ($request->isPost()) {
			$todoEntity = $this->di['todoEntity'];
			$todoEntity->setTitle($request->get("todo"));
			$insertTodoUseCase->insertTodo($todoEntity);
			$response->redirect("");
		}
	}
	public function deleteAction()
	{
		$deleteTodoUseCase = $this->di['deleteTodoUseCase'];
		$request = $this->di['request'];
		$response = $this->di['response'];

		if ($request->isPost()) {
			$id = $request->get("id");
			$deleteTodoUseCase->deleteById($id);
			$response->redirect("");
		}
	}
	public function updateAction()
	{
		$updateTodoUseCase = $this->di['updateTodoUseCase'];
		$request = $this->di['request'];
		$response = $this->di['response'];

		if ($request->isPost()) {
			$id = $request->get("id");
			$title = $request->get("title");

			$todoEntity = $this->di['todoEntity'];
			$todoEntity->setId($id);
			$todoEntity->setTitle($title);

			$updateTodoUseCase->update($todoEntity);
			$response->redirect("");
		}
	}
	public function pdfAction()
	{
		// $domPdf = $this->di['dompdf'];
		$request = $this->di['request'];
		$getTodoUseCase = $this->di['getTodoUseCase'];

		$todos = $getTodoUseCase->getAll();

		if ($request->isPost()) {
			$generatePdfUseCase = $this->di['generatePdfUseCase'];
			$html = $generatePdfUseCase->generateHtml($todos);
			$generatePdfUseCase->generateFromHtml($html);
		}
	}
}
