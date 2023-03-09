<?php include "config/database.php"; ?>
<?php
    if (!isset($_COOKIE['user_id'])) {
        header('Location: login.php');
    }

    $user_id = $_COOKIE['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
</head>

<body>
    <header>
        <nav>
            <?php if($_SERVER['REQUEST_URI'] != "/request.php"): ?>
                <a href="/request.php" class="primary-btn">Request</a>
            <?php endif ?>
            <a href="/login.html" class="danger-btn">Log out</a>
        </nav>
    </header>
</body>

</html>