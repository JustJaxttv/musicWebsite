<?php
require_once '../config/Database.php';
require_once '../models/Song.php';

class SongController {
    private $db;
    private $songModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->songModel = new Song($this->db);
    }

    // List all songs
    public function listSongs() {
        $songs = $this->songModel->getAllSongs();
        include 'views/song_list.php';
    }

    // View a single song by ID
    public function viewSong($id) {
        $song = $this->songModel->getSongById($id);
        include 'views/song_view.php';
    }

    // Add a new song
    public function addSong($title, $artist_id, $album, $genre, $release_date) {
        $this->songModel->title = $title;
        $this->songModel->artist_id = $artist_id;
        $this->songModel->album = $album;
        $this->songModel->genre = $genre;
        $this->songModel->release_date = $release_date;

        if ($this->songModel->addSong()) {
            header('Location: index.php');
        } else {
            echo "Error adding song.";
        }
    }

    // Update an existing song
    public function updateSong($id, $title, $artist_id, $album, $genre, $release_date) {
        $this->songModel->title = $title;
        $this->songModel->artist_id = $artist_id;
        $this->songModel->album = $album;
        $this->songModel->genre = $genre;
        $this->songModel->release_date = $release_date;

        if ($this->songModel->updateSong($id)) {
            header('Location: index.php');
        } else {
            echo "Error updating song.";
        }
    }

    // Delete a song by ID
    public function deleteSong($id) {
        if ($this->songModel->deleteSong($id)) {
            header('Location: index.php');
        } else {
            echo "Error deleting song.";
        }
    }
}

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $songController = new SongController();

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $songController->addSong($_POST['title'], $_POST['artist_id'], $_POST['album'], $_POST['genre'], $_POST['release_date']);
        } elseif ($_POST['action'] === 'update') {
            $songController->updateSong($_POST['id'], $_POST['title'], $_POST['artist_id'], $_POST['album'], $_POST['genre'], $_POST['release_date']);
        }
    }
}

// Handle delete action via GET request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $songController = new SongController();
    $songController->deleteSong($_GET['id']);
}

// Handle view action via GET request
if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
    $songController = new SongController();
    $songController->viewSong($_GET['id']);
}
?>