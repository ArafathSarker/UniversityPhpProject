<?php

class RoomController {
    public function index() {
        // Mock data for room listing
        $rooms = [
            [
                'id' => 1,
                'title' => 'Modern Studio Apartment',
                'location' => 'Downtown, City Center',
                'price' => 500,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1, 'baths' => 1, 'sqft' => 450, 'type' => 'Studio'
            ],
            [
                'id' => 2,
                'title' => 'Cozy Private Room near Campus',
                'location' => 'University District',
                'price' => 200,
                'image' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1, 'baths' => 1, 'sqft' => 150, 'type' => 'Private Room'
            ],
            [
                'id' => 3,
                'title' => 'Spacious Master Bedroom',
                'location' => 'Westside Suburbs',
                'price' => 350,
                'image' => 'https://images.unsplash.com/photo-1484154218962-a1c002085d2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1, 'baths' => 1, 'sqft' => 250, 'type' => 'Shared House'
            ],
            [
                'id' => 4,
                'title' => 'Luxury Penthouse Suite',
                'location' => 'Financial District',
                'price' => 1500,
                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 2, 'baths' => 2, 'sqft' => 1200, 'type' => 'Apartment'
            ],
            [
                'id' => 5,
                'title' => 'Sunny Room with Balcony',
                'location' => 'North Hills',
                'price' => 300,
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1, 'baths' => 1, 'sqft' => 180, 'type' => 'Shared House'
            ],
            [
                'id' => 6,
                'title' => 'Affordable Shared Room',
                'location' => 'Eastside',
                'price' => 150,
                'image' => 'https://images.unsplash.com/photo-1505693416388-b0346ef414b9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'beds' => 1, 'baths' => 1, 'sqft' => 120, 'type' => 'Shared Room'
            ]
        ];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/rooms.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function show($id) {
        // Mock fetching single room
        $room = [
            'id' => $id,
            'title' => 'Modern Studio Apartment',
            'location' => 'Downtown, City Center',
            'price' => 500,
            'description' => 'Experience the best of city living in this modern studio apartment. Fully furnished with high-end appliances, this space is perfect for young professionals or students. Located right in the heart of downtown, you are walking distance to all major transit hubs, restaurants, and nightlife.',
            'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80',
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80'
            ],
            'amenities' => ['Wifi', 'Air Conditioning', 'Kitchen', 'Washer', 'Dryer', 'Elevator', 'Gym'],
            'host' => [
                'name' => 'Sarah Jenkins',
                'joined' => '2021',
                'image' => 'https://randomuser.me/api/portraits/women/44.jpg'
            ]
        ];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/room_details.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
