<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch a user by username
    public function getUserByUsername($username) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new user
    public function addUser() {
        $query = 'INSERT INTO ' . $this->table . ' (username, password, role) VALUES (:username, :password, :role)';
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->role = htmlspecialchars(strip_tags($this->role));

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }

    // Update an existing user's role
    public function updateUserRole($id, $role) {
        $query = 'UPDATE ' . $this->table . ' SET role = :role WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->role = htmlspecialchars(strip_tags($role));

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }

    // Delete a user by ID
    public function deleteUser($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Fetch all users
    public function getAllUsers() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>