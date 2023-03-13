<?php include "config/database.php"; ?>
<?php
    if (!isset($_COOKIE['user_id'])) {
        header('Location: login.php');
        return;
    }

    $user_id = $_COOKIE['user_id'];
    $login_sql = "SELECT is_admin from users where user_id = $user_id;";
    $result = mysqli_query($conn, $login_sql);
    $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(empty($result_set)){
        header('Location: login.php');
        return;
    }

    $is_admin = $result_set[0]["is_admin"] == 1;
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
            <?php if ($is_admin) : ?>
                <a href="/request.php" class="primary-btn">Add Asset</a>
            <?php endif ?>
            <?php if ($_SERVER['REQUEST_URI'] != "/request.php") : ?>
                <a href="/request.php" class="primary-btn">Request</a>
            <?php endif ?>
            <a href="/login.html" class="danger-btn">Log out</a>
        </nav>
    </header>
</body>

</html>