<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Image upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Check email exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        echo "<div class='alert alert-danger'>Email already exists!</div>";
    } else {
        $conn->query("INSERT INTO users (name,email,password,profile_image) VALUES ('$name','$email','$password','$image')");
        echo "<div class='alert alert-success'>Registration successful! <a href='login.php'>Login here</a></div>";
    }
}
?>

<h2>Register</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Full Name" required class="form-control mb-2">
    <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
    <input type="file" name="image" class="form-control mb-2">
    <button class="btn btn-primary">Register</button>
</form>

<?php include 'footer.php'; ?>
