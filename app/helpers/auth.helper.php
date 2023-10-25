<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::init();
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_NAME'] = $user->user_name; 
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {
        AuthHelper::init();
        if (AuthHelper::isLogin()) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }

    public static function isLogin() {
        AuthHelper::init();
        if (!isset($_SESSION['USER_NAME'])) {
            return true;
        }
    }
}