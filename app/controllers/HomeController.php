<?php

class HomeController {
    public function index() {
        // In a real app, you might fetch featured rooms from a model here
        $featuredRooms = [
            [
                'id' => 1,
                'title' => 'Modern Studio Apartment',
                'location' => 'Downtown, City Center',
                'price' => 500,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1,
                'baths' => 1,
                'sqft' => 450
            ],
            [
                'id' => 2,
                'title' => 'Cozy Private Room near Campus',
                'location' => 'University District',
                'price' => 200,
                'image' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1,
                'baths' => 1, // Shared
                'sqft' => 150
            ],
            [
                'id' => 3,
                'title' => 'Spacious Master Bedroom',
                'location' => 'Westside Suburbs',
                'price' => 350,
                'image' => 'https://images.unsplash.com/photo-1484154218962-a1c002085d2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1,
                'baths' => 1, // Private
                'sqft' => 250
            ]
        ];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
