<?php
class Artist {
    private $conn;
    private $table = 'artists';

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all artists
    public function getAllArtists() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch a single artist by ID
    public function getArtistById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new artist
    public function addArtist() {
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    // Update an existing artist
    public function updateArtist($id) {
        $query = 'UPDATE ' . $this->table . ' SET name = :name WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    // Delete an artist by ID
    public function deleteArtist($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>