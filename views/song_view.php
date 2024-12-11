<?php include_once "./layout/header.php"; ?>

<h2>Song Details</h2>

<?php if ($song): ?>
    <p><strong>Title:</strong> <?php echo htmlspecialchars($song['title']); ?></p>
    <p><strong>Artist:</strong> <?php echo htmlspecialchars($song['artist_name']); ?></p>
    <p><strong>Album:</strong> <?php echo htmlspecialchars($song['album']); ?></p>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($song['genre']); ?></p>
    <p><strong>Release Date:</strong> <?php echo htmlspecialchars($song['release_date']); ?></p>
<?php else: ?>
    <p>Song not found.</p>
<?php endif; ?>

<a href="../controllers/SongController.php?action=list">Back to Song List</a>

<?php include_once "./layout/footer.php"; ?>
