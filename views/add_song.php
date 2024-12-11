<?php include __DIR__ . "/../views/layout/header.php"; ?>
<h2>Add Song</h2>
<form method="POST" action="/controllers/SongController.php?action=add">
    Title: <input type="text" name="title" required><br>
    Artist ID: <input type="number" name="artist_id" required><br>
    Album: <input type="text" name="album"><br>
    Genre: <input type="text" name="genre"><br>
    Release Date: <input type="date" name="release_date"><br>
    <input type="submit" value="Add Song">
</form>
<?php include __DIR__ . "/../views/layout/footer.php"; ?>