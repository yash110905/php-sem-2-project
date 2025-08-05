<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); } ?>

<h2>Manage Website Content</h2>

<?php
// Handle content creation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $user_id = $_SESSION['user_id'];
    
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    }

    $conn->query("INSERT INTO content (title, body, image, created_by) VALUES ('$title','$body','$image','$user_id')");
    echo "<div class='alert alert-success'>Content added successfully!</div>";
}
?>

<form method="POST" enctype="multipart/form-data" class="mb-4">
    <input type="text" name="title" placeholder="Title" required class="form-control mb-2">
    <textarea name="body" placeholder="Content Body" required class="form-control mb-2"></textarea>
    <input type="file" name="image" class="form-control mb-2">
    <button class="btn btn-success">Add Content</button>
</form>

<h3>Existing Content</h3>
<table class="table table-bordered">
<tr><th>ID</th><th>Title</th><th>Image</th><th>Action</th></tr>
<?php
$result = $conn->query("SELECT * FROM content ORDER BY created_at DESC");
while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['title'] ?></td>
    <td><?php if($row['image']) echo "<img src='uploads/{$row['image']}' width='50'>"; ?></td>
    <td>
        <a href="edit_content.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete_content.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this content?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>
