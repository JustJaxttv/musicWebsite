<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Artist.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize database connection
$database = new Database();
$db = $database->Connect();

// Initialize the Artist model
$artist = new Artist($db);

// Determine the action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        // Fetch all artists
        $artists = $artist->getAllArtists();
        include '../views/artist_view.php';
        break;

    case 'view':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Artist ID not provided.');
        $artistData = $artist->getArtistById($id);
        include '../views/artist_detail.php';
        break;

    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $artist->addArtist($name);
            header('Location: ArtistController.php?action=list');
        } else {
            include '../views/add_artist.php';
        }
        break;

    case 'update':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Artist ID not provided.');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $artist->updateArtist($id, $name);
            header('Location: ArtistController.php?action=list');
        } else {
            $artistData = $artist->getArtistById($id);
            include '../views/add_artist.php';
        }
        break;

    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Artist ID not provided.');
        $artist->deleteArtist($id);
        header('Location: ArtistController.php?action=list');
        break;

    default:
        echo "Invalid action.";
        break;
}
?>
