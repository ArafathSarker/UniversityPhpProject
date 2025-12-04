<?php

class Room {
    private $conn;
    private $table = 'rooms';

    public $id;
    public $title;
    public $description;
    public $price;
    public $location;
    public $type;
    public $beds;
    public $baths;
    public $sqft;
    public $image;
    public $status;
    public $rent_type;
    public $amenities;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all rooms
    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get single room
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->location = $row['location'];
            $this->type = $row['type'];
            $this->beds = $row['beds'];
            $this->baths = $row['baths'];
            $this->sqft = $row['sqft'];
            $this->image = $row['image'];
            $this->status = $row['status'];
            $this->rent_type = $row['rent_type'];
            $this->amenities = $row['amenities'];
            return true;
        }
        return false;
    }

    // Create Room
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                title = :title,
                description = :description,
                price = :price,
                location = :location,
                type = :type,
                beds = :beds,
                baths = :baths,
                sqft = :sqft,
                image = :image,
                status = :status,
                rent_type = :rent_type,
                amenities = :amenities';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->beds = htmlspecialchars(strip_tags($this->beds));
        $this->baths = htmlspecialchars(strip_tags($this->baths));
        $this->sqft = htmlspecialchars(strip_tags($this->sqft));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->rent_type = htmlspecialchars(strip_tags($this->rent_type));
        $this->amenities = htmlspecialchars(strip_tags($this->amenities));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':beds', $this->beds);
        $stmt->bindParam(':baths', $this->baths);
        $stmt->bindParam(':sqft', $this->sqft);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':rent_type', $this->rent_type);
        $stmt->bindParam(':amenities', $this->amenities);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update Room
    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
            SET 
                title = :title,
                description = :description,
                price = :price,
                location = :location,
                type = :type,
                beds = :beds,
                baths = :baths,
                sqft = :sqft,
                image = :image,
                status = :status,
                rent_type = :rent_type,
                amenities = :amenities
            WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->beds = htmlspecialchars(strip_tags($this->beds));
        $this->baths = htmlspecialchars(strip_tags($this->baths));
        $this->sqft = htmlspecialchars(strip_tags($this->sqft));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->rent_type = htmlspecialchars(strip_tags($this->rent_type));
        $this->amenities = htmlspecialchars(strip_tags($this->amenities));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':beds', $this->beds);
        $stmt->bindParam(':baths', $this->baths);
        $stmt->bindParam(':sqft', $this->sqft);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':rent_type', $this->rent_type);
        $stmt->bindParam(':amenities', $this->amenities);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Filter rooms
    public function filter($location, $type, $price_range, $min_price, $max_price, $amenities, $sort = '') {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE status = "Available"';
        
        if (!empty($location)) {
            $query .= ' AND location LIKE :location';
        }
        
        if (!empty($type)) {
            if (is_array($type)) {
                $placeholders = [];
                foreach ($type as $k => $v) {
                    $placeholders[] = ":type{$k}";
                }
                $query .= ' AND type IN (' . implode(',', $placeholders) . ')';
            } else {
                $query .= ' AND type = :type';
            }
        }
        
        // Price range logic (from home page)
        if (!empty($price_range)) {
            if ($price_range == '0-500') {
                $query .= ' AND price <= 500';
            } elseif ($price_range == '500-1000') {
                $query .= ' AND price > 500 AND price <= 1000';
            } elseif ($price_range == '1000+') {
                $query .= ' AND price > 1000';
            }
        }

        // Min/Max Price logic (from rooms page)
        if (!empty($min_price)) {
            $query .= ' AND price >= :min_price';
        }
        if (!empty($max_price)) {
            $query .= ' AND price <= :max_price';
        }

        // Amenities logic
        if (!empty($amenities) && is_array($amenities)) {
            foreach ($amenities as $k => $amenity) {
                // Using LIKE for simple comma-separated check. 
                // Note: This is a simple approach. For robust tagging, a many-to-many table is better.
                // But given the current schema (TEXT column), this works.
                $query .= " AND amenities LIKE :amenity{$k}";
            }
        }
        
        // Sorting logic
        if ($sort == 'price_asc') {
            $query .= ' ORDER BY price ASC';
        } elseif ($sort == 'price_desc') {
            $query .= ' ORDER BY price DESC';
        } elseif ($sort == 'newest') {
            $query .= ' ORDER BY created_at DESC';
        } else {
            $query .= ' ORDER BY created_at DESC'; // Default
        }
        
        $stmt = $this->conn->prepare($query);
        
        if (!empty($location)) {
            $location = "%{$location}%";
            $stmt->bindParam(':location', $location);
        }
        
        if (!empty($type)) {
            if (is_array($type)) {
                foreach ($type as $k => $v) {
                    $stmt->bindValue(":type{$k}", $v);
                }
            } else {
                $stmt->bindParam(':type', $type);
            }
        }

        if (!empty($min_price)) {
            $stmt->bindParam(':min_price', $min_price);
        }
        if (!empty($max_price)) {
            $stmt->bindParam(':max_price', $max_price);
        }

        if (!empty($amenities) && is_array($amenities)) {
            foreach ($amenities as $k => $amenity) {
                $amenityParam = "%{$amenity}%";
                $stmt->bindValue(":amenity{$k}", $amenityParam);
            }
        }
        
        $stmt->execute();
        return $stmt;
    }

    // Delete Room
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get featured rooms (limit 3)
    public function getFeatured() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE status = "Available" ORDER BY created_at DESC LIMIT 3';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Count total rooms
    public function count() {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
