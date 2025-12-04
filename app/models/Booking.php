<?php

class Booking {
    private $conn;
    private $table = 'bookings';

    public $id;
    public $user_id;
    public $room_id;
    public $check_in;
    public $check_out;
    public $total_price;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all bookings with user and room details
    public function read() {
        $query = 'SELECT 
                    b.id,
                    b.check_in,
                    b.check_out,
                    b.total_price,
                    b.status,
                    u.first_name,
                    u.last_name,
                    r.title as room_title
                  FROM ' . $this->table . ' b
                  LEFT JOIN users u ON b.user_id = u.id
                  LEFT JOIN rooms r ON b.room_id = r.id
                  ORDER BY b.created_at DESC';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get recent bookings
    public function getRecent($limit = 5) {
        $query = 'SELECT 
                    b.id,
                    b.check_in,
                    b.check_out,
                    b.total_price,
                    b.status,
                    u.first_name,
                    u.last_name,
                    r.title as room_title
                  FROM ' . $this->table . ' b
                  LEFT JOIN users u ON b.user_id = u.id
                  LEFT JOIN rooms r ON b.room_id = r.id
                  ORDER BY b.created_at DESC
                  LIMIT :limit';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Count active bookings
    public function countActive() {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE status = "Confirmed" OR status = "Pending"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Calculate total revenue
    public function totalRevenue() {
        $query = 'SELECT SUM(total_price) as total FROM ' . $this->table . ' WHERE status = "Confirmed"';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    // Get bookings by user ID
    public function getBookingsByUserId($user_id) {
        $query = 'SELECT 
                    b.id,
                    b.check_in,
                    b.check_out,
                    b.total_price,
                    b.status,
                    r.title as room_title,
                    r.image as room_image
                  FROM ' . $this->table . ' b
                  LEFT JOIN rooms r ON b.room_id = r.id
                  WHERE b.user_id = :user_id
                  ORDER BY b.created_at DESC';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt;
    }

    // Create Booking
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                user_id = :user_id,
                room_id = :room_id,
                check_in = :check_in,
                check_out = :check_out,
                total_price = :total_price,
                status = :status';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->room_id = htmlspecialchars(strip_tags($this->room_id));
        $this->check_in = htmlspecialchars(strip_tags($this->check_in));
        $this->check_out = htmlspecialchars(strip_tags($this->check_out));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':room_id', $this->room_id);
        $stmt->bindParam(':check_in', $this->check_in);
        $stmt->bindParam(':check_out', $this->check_out);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':status', $this->status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cancel Booking
    public function cancel($id) {
        $query = 'UPDATE ' . $this->table . ' SET status = "Cancelled" WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Approve Booking
    public function approve($id) {
        $query = 'UPDATE ' . $this->table . ' SET status = "Confirmed" WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get single booking details
    public function read_single() {
        $query = 'SELECT 
                    b.id,
                    b.check_in,
                    b.check_out,
                    b.total_price,
                    b.status,
                    b.created_at,
                    u.first_name,
                    u.last_name,
                    u.email,
                    r.title as room_title,
                    r.image as room_image,
                    r.location,
                    r.price as room_price,
                    r.rent_type
                  FROM ' . $this->table . ' b
                  LEFT JOIN users u ON b.user_id = u.id
                  LEFT JOIN rooms r ON b.room_id = r.id
                  WHERE b.id = ?
                  LIMIT 0,1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            return $row;
        }
        return false;
    }

    // Get user stats
    public function getUserStats($user_id) {
        $query = 'SELECT 
                    COUNT(*) as total_bookings,
                    SUM(CASE WHEN status = "Confirmed" THEN total_price ELSE 0 END) as total_spent
                  FROM ' . $this->table . ' 
                  WHERE user_id = :user_id';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
