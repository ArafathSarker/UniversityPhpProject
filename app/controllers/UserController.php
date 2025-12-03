<?php

class UserController {
    public function dashboard() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /?page=login');
            exit;
        }

        // User data from session
        $user = [
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'joined' => 'N/A' 
        ];

        // Mock bookings data
        $bookings = [
            [
                'id' => 101,
                'room_title' => 'Modern Studio Apartment',
                'date' => '2023-12-05',
                'time' => '14:00 - 16:00',
                'status' => 'Confirmed',
                'price' => 1000,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80'
            ],
            [
                'id' => 102,
                'room_title' => 'Cozy 1BHK',
                'date' => '2023-12-10',
                'time' => '10:00 - 13:00',
                'status' => 'Pending',
                'price' => 2400,
                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80'
            ]
        ];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/user/dashboard.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
