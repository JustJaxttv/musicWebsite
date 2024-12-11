<?php
class Song {
    private $conn;
    private $table_name = 'songs';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllSongs() {
        $query = "SELECT songs.id, songs.title, songs.album, songs.genre, songs.release_date, artists.name 
                  FROM " . $this->table_name . " 
                  LEFT JOIN artists ON songs.artist_id = artists.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    

    public function getSongById($id) {
        $query = "SELECT id, title, artist_id, album, genre, release_date FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addSong($title, $artist_id, $album, $genre, $release_date) {
        $query = "INSERT INTO " . $this->table_name . " (title, artist_id, album, genre, release_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$title, $artist_id, $album, $genre, $release_date]);
    }

    public function updateSong($id, $title, $artist_id, $album, $genre, $release_date) {
        $query = "UPDATE " . $this->table_name . " SET title = ?, artist_id = ?, album = ?, genre = ?, release_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$title, $artist_id, $album, $genre, $release_date, $id]);
    }

    public function deleteSong($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
?>
