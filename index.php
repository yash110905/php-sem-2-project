<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<h2>Welcome to Our Blog</h2>
<p>This is the public home page where content is displayed.</p>

<?php
$result = $conn->query("SELECT * FROM content ORDER BY created_at DESC");
while($row = $result->fetch_assoc()): ?>
    <div class="card mt-3">
        <div class="card-body">
            <h4><?php echo $row['title']; ?></h4>
            <p><?php echo $row['body']; ?></p>
            <?php if($row['image']): ?>
                <img src="uploads/<?php echo $row['image']; ?>" width="200">
            <?php endif; ?>
        </div>
    </div>
<?php endwhile; ?>

<?php include 'footer.php'; ?>
