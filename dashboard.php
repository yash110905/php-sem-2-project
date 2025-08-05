<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); } ?>

<h2>All Registered Users</h2>
<table class="table table-bordered">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Action</th></tr>
<?php
$result = $conn->query("SELECT * FROM users");
while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?php if($row['profile_image']) echo "<img src='uploads/{$row['profile_image']}' width='50'>"; ?></td>
    <td>
        <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>
