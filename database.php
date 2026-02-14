<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Database Records</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <h1>📊 Car Records</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="database.php" class="active">Database</a>
    </nav>
</header>

<main class="table-container">

<div class="grid-table header">
    <div>ID</div>
    <div>Car ID</div>
    <div>Speed</div>
    <div>Status</div>
    <div>Date</div>
</div>

<?php
$result = $conn->query("SELECT * FROM car_records ORDER BY id DESC");
while($row = $result->fetch_assoc()):
?>

<div class="grid-table row">
    <div><?php echo $row['id']; ?></div>
    <div><?php echo $row['car_id']; ?></div>
    <div><?php echo number_format($row['speed'],2); ?> km/h</div>
    <div class="<?php echo strtolower($row['status']); ?>">
        <?php echo $row['status']; ?>
    </div>
    <div><?php echo $row['created_at']; ?></div>
</div>

<?php endwhile; ?>

</main>

<footer>
    Smart IoT Monitoring System © 2026
</footer>

</body>
</html>
