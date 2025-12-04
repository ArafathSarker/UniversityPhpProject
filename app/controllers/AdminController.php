<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Booking.php';

class AdminController {
    private $db;
    private $room;
    private $user;
    private $booking;

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

        $database = new Database();
        $this->db = $database->connect();
        $this->room = new Room($this->db);
        $this->user = new User($this->db);
        $this->booking = new Booking($this->db);
    }

    public function dashboard() {
        // Real data for dashboard stats
        $stats = [
            'total_rooms' => $this->room->count(),
            'total_users' => 0, // Need to implement count in User model
            'active_bookings' => $this->booking->countActive(),
            'revenue' => $this->booking->totalRevenue()
        ];

        // Get total users count manually for now or add method to User model
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Real data for recent bookings
        $result = $this->booking->getRecent(5);
        $recentBookings = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $status_color = 'yellow';
            if ($row['status'] == 'Confirmed') $status_color = 'green';
            if ($row['status'] == 'Cancelled') $status_color = 'red';

            $recentBookings[] = [
                'user' => $row['first_name'] . ' ' . $row['last_name'],
                'room' => $row['room_title'],
                'status' => $row['status'],
                'amount' => $row['total_price'],
                'status_color' => $status_color
            ];
        }

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function rooms() {
        // Real data for rooms
        $result = $this->room->read();
        $rooms = $result->fetchAll(PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../views/admin/rooms.php';
    }

    public function users() {
        // Real data for users
        $query = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = [
                'id' => $row['id'],
                'name' => $row['first_name'] . ' ' . $row['last_name'],
                'email' => $row['email'],
                'role' => 'User',
                'joined' => date('Y-m-d', strtotime($row['created_at']))
            ];
        }
        require_once __DIR__ . '/../views/admin/users.php';
    }

    public function bookings() {
        // Real data for bookings
        $result = $this->booking->read();
        $bookings = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $bookings[] = [
                'id' => $row['id'],
                'user' => $row['first_name'] . ' ' . $row['last_name'],
                'room' => $row['room_title'],
                'date' => $row['check_in'] . ' to ' . $row['check_out'],
                'status' => $row['status'],
                'amount' => $row['total_price']
            ];
        }
        require_once __DIR__ . '/../views/admin/bookings.php';
    }

    public function bookingDetails() {
        if (!isset($_GET['id'])) {
            header('Location: /?page=admin_bookings');
            exit;
        }

        $this->booking->id = $_GET['id'];
        $booking = $this->booking->read_single();

        if (!$booking) {
            echo "Booking not found.";
            return;
        }

        require_once __DIR__ . '/../views/admin/booking_details.php';
    }

    public function cancelBooking() {
        if (isset($_GET['id'])) {
            if ($this->booking->cancel($_GET['id'])) {
                header('Location: /?page=admin_bookings&success=cancelled');
            } else {
                header('Location: /?page=admin_bookings&error=cancel_failed');
            }
        } else {
            header('Location: /?page=admin_bookings');
        }
        exit;
    }

    public function approveBooking() {
        if (isset($_GET['id'])) {
            if ($this->booking->approve($_GET['id'])) {
                header('Location: /?page=admin_bookings&success=approved');
            } else {
                header('Location: /?page=admin_bookings&error=approve_failed');
            }
        } else {
            header('Location: /?page=admin_bookings');
        }
        exit;
    }

    public function addRoom() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->room->title = $_POST['title'];
            $this->room->description = $_POST['description'];
            $this->room->price = $_POST['price'];
            $this->room->location = $_POST['location'];
            $this->room->type = $_POST['type'];
            $this->room->beds = $_POST['beds'];
            $this->room->baths = $_POST['baths'];
            $this->room->sqft = $_POST['sqft'];
            $this->room->image = $_POST['image']; // In real app, handle file upload
            $this->room->rent_type = $_POST['rent_type'];
            $this->room->status = 'Available';
            
            $amenities = isset($_POST['amenities']) ? implode(',', $_POST['amenities']) : '';
            $this->room->amenities = $amenities;

            if ($this->room->create()) {
                header('Location: /?page=admin_rooms');
                exit;
            } else {
                // Handle error
                echo "Error creating room.";
            }
        }
        require_once __DIR__ . '/../views/admin/add_room.php';
    }

    public function editRoom() {
        if (!isset($_GET['id'])) {
            header('Location: /?page=admin_rooms');
            exit;
        }

        $this->room->id = $_GET['id'];
        $this->room->read_single();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->room->title = $_POST['title'];
            $this->room->description = $_POST['description'];
            $this->room->price = $_POST['price'];
            $this->room->location = $_POST['location'];
            $this->room->type = $_POST['type'];
            $this->room->beds = $_POST['beds'];
            $this->room->baths = $_POST['baths'];
            $this->room->sqft = $_POST['sqft'];
            $this->room->image = $_POST['image'];
            $this->room->rent_type = $_POST['rent_type'];
            $this->room->status = $_POST['status'];
            
            $amenities = isset($_POST['amenities']) ? implode(',', $_POST['amenities']) : '';
            $this->room->amenities = $amenities;

            if ($this->room->update()) {
                header('Location: /?page=admin_rooms&success=updated');
                exit;
            } else {
                echo "Error updating room.";
            }
        }

        // Pass room data to view
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
            'status' => $this->room->status,
            'amenities' => $this->room->amenities
        ];

        require_once __DIR__ . '/../views/admin/edit_room.php';
    }

    public function deleteRoom() {
        if (isset($_GET['id'])) {
            $this->room->id = $_GET['id'];
            if ($this->room->delete()) {
                header('Location: /?page=admin_rooms&success=deleted');
            } else {
                header('Location: /?page=admin_rooms&error=delete_failed');
            }
        } else {
            header('Location: /?page=admin_rooms');
        }
        exit;
    }

    public function deleteUser() {
        if (isset($_GET['id'])) {
            $this->user->id = $_GET['id'];
            if ($this->user->delete()) {
                header('Location: /?page=admin_users&success=deleted');
            } else {
                header('Location: /?page=admin_users&error=delete_failed');
            }
        } else {
            header('Location: /?page=admin_users');
        }
        exit;
    }
}
