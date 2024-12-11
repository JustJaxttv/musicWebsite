<?php include '../views/layout/header.php'; ?>
<h2>Add Artist</h2>
<form method="POST" action="../controllers/ArtistController.php?action=add">
    Name: <input type="text" name="name" required><br>
    <input type="submit" value="Add Artist">
</form>
<?php include '../views/layout/footer.php'; ?>