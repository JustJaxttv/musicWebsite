<?php
class Song {
    private $conn;
    private $table = 'songs';

    public $id;
    public $title;
    public $artist_id;
    public $album;
    public $genre;
    public $release_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all songs with artist details
    public function getAllSongs() {
        $query = 'SELECT songs.*, artists.name AS artist_name FROM ' . $this->table . ' 
                  JOIN artists ON songs.artist_id = artists.id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch a single song by ID
    public function getSongById($id) {
        $query = 'SELECT songs.*, artists.name AS artist_name FROM ' . $this->table . ' 
                  JOIN artists ON songs.artist_id = artists.id WHERE songs.id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new song
    public function addSong() {
        $query = 'INSERT INTO ' . $this->table . ' (title, artist_id, album, genre, release_date) 
                  VALUES (:title, :artist_id, :album, :genre, :release_date)';
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->album = htmlspecialchars(strip_tags($this->album));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->release_date = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':artist_id', $this->artist_id);
        $stmt->bindParam(':album', $this->album);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':release_date', $this->release_date);

        return $stmt->execute();
    }

    // Update an existing song
    public function updateSong($id) {
        $query = 'UPDATE ' . $this->table . ' 
                  SET title = :title, artist_id = :artist_id, album = :album, genre = :genre, release_date = :release_date 
                  WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->album = htmlspecialchars(strip_tags($this->album));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->release_date = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':artist_id', $this->artist_id);
        $stmt->bindParam(':album', $this->album);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':release_date', $this->release_date);

        return $stmt->execute();
    }

    // Delete a song by ID
    public function deleteSong($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>