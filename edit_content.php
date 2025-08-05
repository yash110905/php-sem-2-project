<?php include 'config.php'; ?>
<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); } ?>

<?php
$id = $_GET['id'];
$content = $conn->query("SELECT * FROM content WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
        $conn->query("UPDATE content SET title='$title', body='$body', image='$image' WHERE id=$id");
    } else {
        $conn->query("UPDATE content SET title='$title', body='$body' WHERE id=$id");
    }
    header("Location: manage_content.php");
}
?>

<h2>Edit Content</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" value="<?= $content['title'] ?>" required class="form-control mb-2">
    <textarea name="body" class="form-control mb-2"><?= $content['body'] ?></textarea>
    <input type="file" name="image" class="form-control mb-2">
    <button class="btn btn-primary">Update Content</button>
</form>

<?php include 'footer.php'; ?>
