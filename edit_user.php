<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); } ?>

<?php
$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // If a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
        $conn->query("UPDATE users SET name='$name', email='$email', profile_image='$image' WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
    }
    header("Location: dashboard.php");
}
?>

<h2>Edit User</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $user['name'] ?>" required class="form-control mb-2">
    <input type="email" name="email" value="<?= $user['email'] ?>" required class="form-control mb-2">
    <input type="file" name="image" class="form-control mb-2">
    <button class="btn btn-primary">Update User</button>
</form>

<?php include 'footer.php'; ?>
