<?php

class CartController {
    public function index() {
        // Mock cart data
        $cartItems = [
            [
                'id' => 1,
                'title' => 'Modern Studio Apartment',
                'price' => 500,
                'hours' => 2,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80'
            ]
        ];
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/cart.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function add() {
        // Logic to add to session cart would go here
        // For now, just redirect to cart
        header('Location: /?page=cart');
    }

    public function checkout() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/checkout.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
