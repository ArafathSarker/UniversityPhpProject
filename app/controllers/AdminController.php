<?php

class AdminController {
    public function __construct() {
        // Prevent caching for all admin pages
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin_id'])) {
            header('Location: /?page=admin_login');
            exit;
        }
    }

    public function dashboard() {
        // Mock data for dashboard stats
        $stats = [
            'total_rooms' => 120,
            'total_users' => 2500,
            'active_bookings' => 45,
            'revenue' => 15000
        ];

        // Mock data for recent bookings
        $recentBookings = [
            ['user' => 'Jane Cooper', 'room' => 'Modern Studio', 'status' => 'Active', 'amount' => 500, 'status_color' => 'green'],
            ['user' => 'Cody Fisher', 'room' => 'Luxury Penthouse', 'status' => 'Pending', 'amount' => 1500, 'status_color' => 'yellow'],
            ['user' => 'Esther Howard', 'room' => 'Cozy 1BHK', 'status' => 'Active', 'amount' => 800, 'status_color' => 'green'],
        ];

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function rooms() {
        // Mock data for rooms
        $rooms = [
            ['id' => 1, 'title' => 'Modern Studio Apartment', 'price' => 500, 'type' => 'Studio', 'status' => 'Available'],
            ['id' => 2, 'title' => 'Luxury Penthouse', 'price' => 1500, 'type' => 'Penthouse', 'status' => 'Booked'],
            ['id' => 3, 'title' => 'Cozy 1BHK', 'price' => 800, 'type' => 'Apartment', 'status' => 'Available'],
        ];
        require_once __DIR__ . '/../views/admin/rooms.php';
    }

    public function users() {
        // Mock data for users
        $users = [
            ['id' => 1, 'name' => 'Jane Cooper', 'email' => 'jane@example.com', 'role' => 'User', 'joined' => '2023-01-15'],
            ['id' => 2, 'name' => 'Cody Fisher', 'email' => 'cody@example.com', 'role' => 'User', 'joined' => '2023-02-20'],
        ];
        require_once __DIR__ . '/../views/admin/users.php';
    }

    public function bookings() {
        // Mock data for bookings
        $bookings = [
            ['id' => 101, 'user' => 'Jane Cooper', 'room' => 'Modern Studio', 'date' => '2023-10-01', 'status' => 'Confirmed', 'amount' => 1000],
            ['id' => 102, 'user' => 'Cody Fisher', 'room' => 'Luxury Penthouse', 'date' => '2023-10-05', 'status' => 'Pending', 'amount' => 3000],
        ];
        require_once __DIR__ . '/../views/admin/bookings.php';
    }

    public function addRoom() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission (mock)
            header('Location: /?page=admin_rooms');
            exit;
        }
        require_once __DIR__ . '/../views/admin/add_room.php';
    }
}
