<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Room.php';

class HomeController {
    private $db;
    private $room;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->room = new Room($this->db);
    }

    public function index() {
        // Fetch featured rooms from database
        $result = $this->room->getFeatured();
        $featuredRooms = $result->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
