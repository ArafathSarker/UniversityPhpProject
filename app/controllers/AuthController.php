<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->user = new User($this->db);
    }

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->user->emailExists()) {
                if (password_verify($password, $this->user->password)) {
                    $_SESSION['user_id'] = $this->user->id;
                    $_SESSION['user_name'] = $this->user->first_name . ' ' . $this->user->last_name;
                    $_SESSION['user_email'] = $this->user->email;
                    
                    header('Location: /?page=home');
                    exit;
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "User not found.";
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function signup() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->email = $_POST['email'];
            
            // Check if email already exists
            if ($this->user->emailExists()) {
                $error = "Email already exists. Please login.";
            } else {
                $this->user->first_name = $_POST['first-name'];
                $this->user->last_name = $_POST['last-name'];
                $this->user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
                if ($this->user->create()) {
                    header('Location: /?page=login&success=registered');
                    exit;
                } else {
                    $error = "Something went wrong. Please try again.";
                }
            }
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/auth/signup.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function logout() {
        // Unset all session values
        $_SESSION = array();

        // get session parameters 
        $params = session_get_cookie_params();

        // Delete the actual cookie. 
        setcookie(session_name(),
            '', time() - 42000, 
            $params["path"], 
            $params["domain"], 
            $params["secure"], 
            $params["httponly"]
        );

        // Destroy session 
        session_destroy();

        header('Location: /?page=login');
        exit;
    }

    public function adminLogout() {
        // Unset all session values
        $_SESSION = array();

        // get session parameters 
        $params = session_get_cookie_params();

        // Delete the actual cookie. 
        setcookie(session_name(),
            '', time() - 42000, 
            $params["path"], 
            $params["domain"], 
            $params["secure"], 
            $params["httponly"]
        );

        // Destroy session 
        session_destroy();

        header('Location: /?page=admin_login');
        exit;
    }

    public function adminLogin() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = 'SELECT * FROM admins WHERE email = :email LIMIT 0,1';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_email'] = $row['email'];
                    header('Location: /?page=admin_dashboard');
                    exit;
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "Admin not found.";
            }
        }
        require_once __DIR__ . '/../views/auth/admin_login.php';
    }
}
