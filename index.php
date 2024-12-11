<?php include_once __DIR__ . "/views/layout/header.php"; ?>

<h2>Welcome to the Music Site</h2>
<p>This site allows you to manage songs, artists, albums, and genres. Use the navigation links below to explore the site.</p>

<ul>
    <li><a href="controllers/ArtistController.php?action=list">View Artists</a></li>
    <li><a href="controllers/SongController.php?action=list">View Songs</a></li>
    <li><a href="views/add_artist.php">Add a New Artist</a></li>
    <li><a href="views/add_song.php">Add a New Song</a></li>
    <li><a href="controllers/AuthController.php?action=logout">Logout</a></li>
</ul>

<?php include_once __DIR__ . "/views/layout/footer.php"; ?>
