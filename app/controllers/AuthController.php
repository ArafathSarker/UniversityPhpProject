<?php

class AuthController {
    public function login() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function signup() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/signup.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function adminLogin() {
        require_once __DIR__ . '/../views/auth/admin_login.php';
    }
}
