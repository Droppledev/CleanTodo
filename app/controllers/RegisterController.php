<?php

class RegisterController extends ControllerBase
{
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $username = $this->request->get("username");
            $password = $this->request->get("password");
            $password2 = $this->request->get("password2");
            $registerUseCase = $this->di['registerUseCase'];
            if ($registerUseCase->isUserExist($username)) {
                $this->flashSession->error("Username already exist !");
                $this->response->redirect("register");
                return;
            }
            if ($password === $password2) {
                $user = $this->di['userEntity'];
                $user->setUsername($username);
                $user->setPassword($password);
                $registerUseCase->register($user);
                $this->flashSession->success("Registration successful, please login !");
                $this->response->redirect("");
                return;
            } else {
                $this->flashSession->error("Password and confirmation password do not match !");
                $this->response->redirect("register");
                return;
            }
        }
    }
}
