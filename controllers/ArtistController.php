<?php
require_once '../config/Database.php';
require_once '../models/Artist.php';

class ArtistController {
    private $db;
    private $artistModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->artistModel = new Artist($this->db);
    }

    // List all artists
    public function listArtists() {
        $artists = $this->artistModel->getAllArtists();
        include 'views/artist_view.php';
    }

    // View a single artist by ID
    public function viewArtist($id) {
        $artist = $this->artistModel->getArtistById($id);
        include 'views/artist_detail.php';
    }

    // Add a new artist
    public function addArtist($name) {
        $this->artistModel->name = $name;
        if ($this->artistModel->addArtist()) {
            header('Location: index.php');
        } else {
            echo "Error adding artist.";
        }
    }

    // Update an existing artist
    public function updateArtist($id, $name) {
        $this->artistModel->name = $name;
        if ($this->artistModel->updateArtist($id)) {
            header('Location: index.php');
        } else {
            echo "Error updating artist.";
        }
    }

    // Delete an artist by ID
    public function deleteArtist($id) {
        if ($this->artistModel->deleteArtist($id)) {
            header('Location: index.php');
        } else {
            echo "Error deleting artist.";
        }
    }
}

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artistController = new ArtistController();

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $artistController->addArtist($_POST['name']);
        } elseif ($_POST['action'] === 'update') {
            $artistController->updateArtist($_POST['id'], $_POST['name']);
        }
    }
}

// Handle delete action via GET request
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $artistController = new ArtistController();
    $artistController->deleteArtist($_GET['id']);
}

// Handle view action via GET request
if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
    $artistController = new ArtistController();
    $artistController->viewArtist($_GET['id']);
}
?>