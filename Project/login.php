<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard.php");
        } else {
            echo "<div class='alert alert-danger'>Invalid password</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No user found</div>";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
    <button class="btn btn-success">Login</button>
</form>

<?php include 'footer.php'; ?>
