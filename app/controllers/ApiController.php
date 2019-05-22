<?php

class ApiController extends ControllerBase
{
    public function todoAction()
    {
        $username = $this->request->get("username");
        $password = $this->request->get("password");
        $loginUseCase = $this->di['loginUseCase'];

        $user = $loginUseCase->getUser($username, $password);

        if ($user) {
            $getTodoUseCase = $this->di['getTodoUseCase'];

            $todos = $getTodoUseCase->getAllToJson($user);

            $this->response->setStatusCode(200);
            $this->response->setJsonContent($todos);
            $this->response->send();
        } else {
            $this->response->setStatusCode(404);
            $this->response->setJsonContent([
                "status" => "Not Found",
                "error" => "Incorrect Username/Password"
            ]);
            $this->response->send();
        }
    }
}
