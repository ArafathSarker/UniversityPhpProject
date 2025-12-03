<?php

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create User
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                password = :password';

        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        // Password is already hashed, do not sanitize it as it might corrupt the hash
        // $this->password = htmlspecialchars(strip_tags($this->password));

        // Bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Login User (Check if email exists)
    public function emailExists() {
        $query = 'SELECT id, first_name, last_name, password FROM ' . $this->table . ' WHERE email = :email LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        // Sanitize for query, but don't modify the object property permanently if possible
        // However, for consistency with other methods, we often sanitize inputs.
        // But here we are using the property.
        // Let's use a local variable for binding
        $clean_email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(':email', $clean_email);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->password = $row['password'];
            return true;
        }

        return false;
    }
}
