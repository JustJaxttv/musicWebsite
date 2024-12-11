<?php include 'layout/header.php'; ?>

<h2>Artist List</h2>

<a href="views/add_artist.php">Add New Artist</a>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($artist = $artists->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($artist['id']); ?></td>
                <td><?php echo htmlspecialchars($artist['name']); ?></td>
                <td>
                    <a href="controllers/ArtistController.php?action=view&id=<?php echo $artist['id']; ?>">View</a> |
                    <a href="views/add_artist.php?id=<?php echo $artist['id']; ?>&action=update">Update</a> |
                    <a href="controllers/ArtistController.php?action=delete&id=<?php echo $artist['id']; ?>" onclick="return confirm('Are you sure you want to delete this artist?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'layout/footer.php'; ?>
