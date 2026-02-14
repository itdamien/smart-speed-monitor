<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="3">
<title>Car Speed Monitor</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <h1>🚗 Smart Speed Monitor</h1>
    <nav>
        <a href="index.php" class="active">Home</a>
        <a href="database.php">Database</a>
    </nav>
</header>

<main class="grid-container">

<?php
$result = $conn->query("SELECT * FROM car_records ORDER BY id DESC LIMIT 1");
$row = $result->fetch_assoc();
?>

<section class="card main-card">
    <h2>Live Speed Data</h2>

    <?php if($row): ?>
        <?php
            $class = "normal";
            if($row['status']=="OVER_SPEED") $class="over";
            if($row['status']=="LOW_SPEED") $class="low";
        ?>

        <div class="speed-display <?php echo $class; ?>">
            <?php echo number_format($row['speed'],2); ?> km/h
        </div>

        <div class="details-grid">
            <div>
                <span>Status</span>
                <strong><?php echo $row['status']; ?></strong>
            </div>
            <div>
                <span>Car ID</span>
                <strong><?php echo $row['car_id']; ?></strong>
            </div>
            <div>
                <span>Recorded At</span>
                <strong><?php echo $row['created_at']; ?></strong>
            </div>
        </div>
    <?php else: ?>
        <p>No data yet...</p>
    <?php endif; ?>
</section>

</main>

<footer>
    Smart IoT Monitoring System © 2026
</footer>

</body>
</html>
