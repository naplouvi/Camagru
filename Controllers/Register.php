<?php

class Register extends Controller
{
    public function index()
    {
        $data = array();
        // Redirect if user is logged on
        if (isset($_SESSION['pseudo'])) {
            header('Location: ' . WEBROOT);
        }

        // Check if post has been requested
        if (isset($_POST['pseudo']) && isset($_POST['email']) &&
            isset($_POST['password']) && isset($_POST['password_confirm']) &&
            isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
            $this->loadModel('UserModel');

            $data = array(
                'pseudo' => trim(htmlspecialchars($_POST['pseudo'])),
                'email' => trim(htmlspecialchars($_POST['email'])),
                'password' => trim(htmlspecialchars($_POST['password'])),
                'password_confirm' => trim(htmlspecialchars($_POST['password_confirm'])),
                'error' => "",
            );

            if (empty($data['pseudo']) || empty($data['email']) || empty($data['password']) || empty($data['password'])) {
                $data['error'] .= "Missing fields in form.";
            } else if ($this->UserModel->user_exists($data['pseudo'], $data['email']) === true) {
                $data['error'] .= "Email or login already taken.";
            } else if ($this->UserModel->check_password($data['password']) != 0) {
                $data['error'] .= "The password is not secure enough. <br />It must be at least 8 characters long, contain one letter letter and one number.<br /> Yeah that sucks.";
            } else if ($data['password'] !== $data['password_confirm']) {
                $data['error'] .= "Passwords don't match.";
            } else if ($this->UserModel->register($data['email'], $data['pseudo'], $data['password']) == false) {
                $data['error'] .= "An error occured on the server, please try again later.";
            } else {
                // Register success
                header('Location: /index.php/register/confirm');
            }
        }
        $this->loadView('Templates/header');
        $this->loadView('Register/index', $data);
        $this->loadView('Templates/footer');
    }

    public function confirm()
    {
        $this->loadView('templates/header');
        $this->loadView('register/confirm');
        $this->loadView('templates/footer');
    }
}
