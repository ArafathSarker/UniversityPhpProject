<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/Booking.php';

class RoomController {
    private $db;
    private $room;
    private $booking;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->room = new Room($this->db);
        $this->booking = new Booking($this->db);
    }

    public function index() {
        $location = $_GET['location'] ?? '';
        $type = $_GET['type'] ?? '';
        $price = $_GET['price'] ?? ''; // From home page
        $min_price = $_GET['min_price'] ?? ''; // From rooms page
        $max_price = $_GET['max_price'] ?? ''; // From rooms page
        $amenities = $_GET['amenities'] ?? []; // From rooms page
        $sort = $_GET['sort'] ?? '';

        // Always use filter to ensure we only show available rooms and handle sorting
        $result = $this->room->filter($location, $type, $price, $min_price, $max_price, $amenities, $sort);
        
        $rooms = $result->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/rooms.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function show($id) {
        $this->room->id = $id;
        if ($this->room->read_single()) {
            $room = [
                'id' => $this->room->id,
                'title' => $this->room->title,
                'description' => $this->room->description,
                'price' => $this->room->price,
                'location' => $this->room->location,
                'type' => $this->room->type,
                'beds' => $this->room->beds,
                'baths' => $this->room->baths,
                'sqft' => $this->room->sqft,
                'image' => $this->room->image,
                'rent_type' => $this->room->rent_type,
                'images' => [$this->room->image, $this->room->image, $this->room->image], // Mock additional images
                'amenities' => !empty($this->room->amenities) ? explode(',', $this->room->amenities) : [],
                'host' => ['name' => 'John Doe', 'joined' => '2021', 'image' => 'https://randomuser.me/api/portraits/men/32.jpg'] // Mock host
            ];
            require_once __DIR__ . '/../views/layouts/header.php';
            require_once __DIR__ . '/../views/room_details.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        } else {
            echo "Room not found.";
        }
    }

    public function book() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['user_id'])) {
                header('Location: /?page=login');
                exit;
            }

            $this->booking->user_id = $_SESSION['user_id'];
            $this->booking->room_id = $_POST['room_id'];
            
            // Fetch room details for price calculation
            $this->room->id = $_POST['room_id'];
            $this->room->read_single();
            
            $rent_type = $_POST['rent_type'];
            
            if ($rent_type == 'Daily') {
                $check_in = $_POST['check_in_date'];
                $check_out = $_POST['check_out_date'];
                
                $date1 = new DateTime($check_in);
                $date2 = new DateTime($check_out);
                $interval = $date1->diff($date2);
                $days = $interval->days;
                
                if ($days < 1) $days = 1; // Minimum 1 day
                
                $this->booking->check_in = $check_in;
                $this->booking->check_out = $check_out;
                $this->booking->total_price = $this->room->price * $days;
                
            } else { // Monthly
                $check_in = $_POST['check_in_date'];
                $duration = (int)$_POST['duration'];
                
                $this->booking->check_in = $check_in;
                $this->booking->check_out = date('Y-m-d', strtotime($check_in . " +$duration months"));
                $this->booking->total_price = $this->room->price * $duration;
            }

            $this->booking->status = 'Pending';

            if ($this->booking->create()) {
                header('Location: /?page=user_dashboard&success=booked');
            } else {
                echo "Booking failed.";
            }
        }
    }
}
