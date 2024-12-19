<?php
session_start();
class Auth {
    public static function check() {
        if (empty($_SESSION['logged_in'])) {
            header('Location: login');
            exit;
        }

        setcookie(session_name(), session_id(), time() + 3600, "/");
    }

    public static function login($password) {
        if (isset($password) && $password === env('ADMIN_PASSWORD')) {
            $_SESSION['logged_in'] = true;

            setcookie(session_name(), session_id(), time() + 3600, "/");
            header('Location: /admin');
            exit;
        }
    }

    public static function logout() {
        session_destroy();
        setcookie(session_name(), session_id(), time() - 3600, "/");
        header('Location: /login');
        exit;
    }
}