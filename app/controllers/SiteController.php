<?php
require_once __DIR__ . '/../helpers/Auth.php';
require_once __DIR__ . '/../models/Upload.php';
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../models/Standard.php';
require_once __DIR__ . '/../models/Subtopic.php';
require_once __DIR__ . '/../models/ResourceType.php';

class SiteController
{
    private ?string $error = null;

    public function login($password)
    {
        if (isset($password) && $password === env('ADMIN_PASSWORD')) {
            Auth::login($password);
        }
        $this->error = 'Invalid password';
    }

    public function logout()
    {
        Auth::logout();
    }

    public function renderLogin()
    {
        $error = $this->error;
        require_once __DIR__ . '/../views/login.php';
    }

}