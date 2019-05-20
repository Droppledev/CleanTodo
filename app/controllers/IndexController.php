<?php

class IndexController extends ControllerBase
{
	public function indexAction()
	{
		if (!$this->session->has("auth")) {
			if ($this->request->isPost()) {
				$username = $this->request->get("username");
				$password = $this->request->get("password");
				$loginUseCase = $this->di['loginUseCase'];

				$user = $loginUseCase->getUser($username, $password);

				if ($user) {
					$this->session->set(
						'auth',
						[
							'id'   => $user->getId(),
							'name' => $user->getUsername(),
						]
					);
					$this->response->redirect("todo");
				} else {
					$this->flashSession->error("Incorrect Username/Password");
					$this->response->redirect("");
				}
			}
		} else {
			$this->response->redirect("todo");
		}
	}
	public function logoutAction()
	{
		$this->session->destroy();
		$this->flashSession->success("You've been logged out successfully");
		$this->response->redirect("");
	}
}
