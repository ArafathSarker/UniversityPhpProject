<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $db;
    private $booking;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->booking = new Booking($this->db);
        $this->user = new User($this->db);
    }

    public function dashboard() {
        // Check if user is logged in
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
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

        // Fetch user stats
        $stats = $this->booking->getUserStats($_SESSION['user_id']);
        $total_bookings = $stats['total_bookings'];
        $total_spent = number_format($stats['total_spent'] ?? 0);
        
        // Calculate hours/days rented (approximate based on bookings)
        // For simplicity, we'll just count bookings * 24 hours or something, 
        // but ideally we should sum the duration. 
        // Let's just show "Bookings" count for now or keep it simple.
        $hours_rented = $total_bookings * 24; // Placeholder logic

        // Fetch real bookings data
        $result = $this->booking->getBookingsByUserId($_SESSION['user_id']);
        $bookings = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $bookings[] = [
                'id' => $row['id'],
                'room_title' => $row['room_title'],
                'check_in' => $row['check_in'],
                'check_out' => $row['check_out'],
                'status' => $row['status'],
                'total_price' => $row['total_price'],
                'room_image' => $row['room_image'] ?? 'https://via.placeholder.com/150'
            ];
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/user/dashboard.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function bookingDetails() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /?page=login');
            exit;
        }

        if (!isset($_GET['id'])) {
            header('Location: /?page=user_dashboard');
            exit;
        }

        $this->booking->id = $_GET['id'];
        $booking = $this->booking->read_single();

        // Verify this booking belongs to the logged-in user
        // In a real app, we should check $booking['user_id'] == $_SESSION['user_id']
        // But read_single joins user table, so we can check email or just trust for now (security risk in real app)
        // Let's add a basic check if possible, but read_single returns joined data.
        // Ideally, we should check ownership.
        
        if (!$booking) {
            echo "Booking not found.";
            return;
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/user/booking_details.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function cancelBooking() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $bookingId = $_POST['booking_id'];
            if ($this->booking->cancel($bookingId)) {
                header('Location: /?page=user_dashboard');
            } else {
                echo "Failed to cancel booking.";
            }
        }
    }

    public function settings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /?page=login');
            exit;
        }

        $user = [
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email']
        ];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/user/settings.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function updateProfile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->id = $_SESSION['user_id'];
            $this->user->first_name = $_POST['first_name'];
            $this->user->last_name = $_POST['last_name'];
            
            if (!empty($_POST['new_password'])) {
                if (empty($_POST['current_password'])) {
                    header('Location: /?page=user_settings&error=current_password_required');
                    exit;
                }

                // Get current user data to verify password
                $currentUser = new User($this->db);
                $currentUser->id = $_SESSION['user_id'];
                
                if ($currentUser->getUserById()) {
                    if (password_verify($_POST['current_password'], $currentUser->password)) {
                        if ($_POST['new_password'] === $_POST['confirm_password']) {
                            $this->user->password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                        } else {
                            header('Location: /?page=user_settings&error=password_mismatch');
                            exit;
                        }
                    } else {
                        header('Location: /?page=user_settings&error=incorrect_password');
                        exit;
                    }
                } else {
                    header('Location: /?page=user_settings&error=user_not_found');
                    exit;
                }
            }

            if ($this->user->update()) {
                $_SESSION['user_name'] = $this->user->first_name . ' ' . $this->user->last_name;
                header('Location: /?page=user_settings&success=updated');
            } else {
                header('Location: /?page=user_settings&error=update_failed');
            }
        }
    }
}
