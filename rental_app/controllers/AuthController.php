<?php
// File: controllers/AuthController.php

require_once __DIR__ . '/../models/user.php';

class AuthController {
    public function login() {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function processLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = User::findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /rental_app/home");
        } else {
            echo "<script>alert('Login gagal. Username/password salah');window.location.href='/rental_app/login';</script>";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /rental_app/login");
    }
}
