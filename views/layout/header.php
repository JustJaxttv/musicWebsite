<!DOCTYPE html>
<html>
<head>
    <title>Music Site</title>
    <link rel="stylesheet" href="/musicWebsite/views/layout/style.css">
</head>
<body>
    <header>
        <h1>Music Site</h1>
        <nav>
            <a href="/musicWebsite/index.php">Home</a>
            <a href="/musicWebsite/controllers/ArtistController.php?action=list">Artists</a>
            <a href="/musicWebsite/views/add_artist.php">Add a New Artist</a>
            <a href="/musicWebsite/controllers/SongController.php?action=list">Songs</a>
            <a href="/musicWebsite/views/add_song.php">Add a New Song</a>
            <a href="/musicWebsite/controllers/AuthController.php?action=logout">Logout</a>
        </nav>
    </header>
    <main>