<?php include 'config.php'; ?>
<?php session_start(); ?>
<?php if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); } ?>

<?php
$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id=$id");
header("Location: dashboard.php");
?>
