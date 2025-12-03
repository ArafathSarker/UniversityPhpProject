<?php

session_start();

// Simple Router
$page = $_GET['page'] ?? 'home';

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/RoomController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/PageController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/CartController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/config/Database.php';

switch ($page) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'rooms':
        $controller = new RoomController();
        $controller->index();
        break;
    case 'room':
        $id = $_GET['id'] ?? 1;
        $controller = new RoomController();
        $controller->show($id);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'signup':
        $controller = new AuthController();
        $controller->signup();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'admin_logout':
        $controller = new AuthController();
        $controller->adminLogout();
        break;
    case 'about':
        $controller = new PageController();
        $controller->about();
        break;
    case 'contact':
        $controller = new PageController();
        $controller->contact();
        break;
    case 'admin_login':
        $controller = new AuthController();
        $controller->adminLogin();
        break;
    case 'admin_dashboard':
        $controller = new AdminController();
        $controller->dashboard();
        break;
    case 'admin_rooms':
        $controller = new AdminController();
        $controller->rooms();
        break;
    case 'admin_add_room':
        $controller = new AdminController();
        $controller->addRoom();
        break;
    case 'admin_users':
        $controller = new AdminController();
        $controller->users();
        break;
    case 'admin_bookings':
        $controller = new AdminController();
        $controller->bookings();
        break;
    case 'cart':
        $controller = new CartController();
        $controller->index();
        break;
    case 'add_to_cart':
        $controller = new CartController();
        $controller->add();
        break;
    case 'checkout':
        $controller = new CartController();
        $controller->checkout();
        break;
    case 'user_dashboard':
        $controller = new UserController();
        $controller->dashboard();
        break;
    case 'test_db':
        $database = new Database();
        $db = $database->connect();
        if ($db) {
            echo "Database Connected Successfully";
        }
        break;
    default:
        // 404 Page could go here, but for now redirect to home
        $controller = new HomeController();
        $controller->index();
        break;
}
