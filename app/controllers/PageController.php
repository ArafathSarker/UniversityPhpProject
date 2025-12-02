<?php

class PageController {
    public function about() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/about.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function contact() {
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/contact.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
