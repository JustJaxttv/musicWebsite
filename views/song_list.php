<?php include 'layout/header.php'; ?>

<h2>Song List</h2>

<a href="views/add_song.php">Add New Song</a>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Album</th>
            <th>Genre</th>
            <th>Release Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($song = $songs->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($song['id']); ?></td>
                <td><?php echo htmlspecialchars($song['title']); ?></td>
                <td><?php echo htmlspecialchars($song['artist_name']); ?></td>
                <td><?php echo htmlspecialchars($song['album']); ?></td>
                <td><?php echo htmlspecialchars($song['genre']); ?></td>
                <td><?php echo htmlspecialchars($song['release_date']); ?></td>
                <td>
                    <a href="controllers/SongController.php?action=view&id=<?php echo $song['id']; ?>">View</a> |
                    <a href="views/add_song.php?id=<?php echo $song['id']; ?>&action=update">Update</a> |
                    <a href="controllers/SongController.php?action=delete&id=<?php echo $song['id']; ?>" onclick="return confirm('Are you sure you want to delete this song?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'layout/footer.php'; ?>
