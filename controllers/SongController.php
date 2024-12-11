<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Song.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize database connection
$database = new Database();
$db = $database->Connect();

// Initialize the Song model
$song = new Song($db);

// Determine the action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        // Fetch all songs
        $songs = $song->getAllSongs();
        include '../views/song_list.php';
        break;

    case 'view':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Song ID not provided.');
        $songData = $song->getSongById($id);
        include '../views/song_view.php';
        break;

    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $artist_id = $_POST['artist_id'];
            $album = $_POST['album'];
            $genre = $_POST['genre'];
            $release_date = $_POST['release_date'];
            $song->addSong($title, $artist_id, $album, $genre, $release_date);
            header('Location: SongController.php?action=list');
        } else {
            include '../views/add_song.php';
        }
        break;

    case 'update':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Song ID not provided.');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $artist_id = $_POST['artist_id'];
            $album = $_POST['album'];
            $genre = $_POST['genre'];
            $release_date = $_POST['release_date'];
            $song->updateSong($id, $title, $artist_id, $album, $genre, $release_date);
            header('Location: SongController.php?action=list');
        } else {
            $songData = $song->getSongById($id);
            include '../views/add_song.php';
        }
        break;

    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : die('Song ID not provided.');
        $song->deleteSong($id);
        header('Location: SongController.php?action=list');
        break;

    default:
        echo "Invalid action.";
        break;
}
?>
