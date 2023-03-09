<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/login.css">
    <title>Login - Asset Managment System</title>
</head>

<body>
    <h1>Asset Management System</h1>
    <?php
        include "config/database.php";

        if (isset($_COOKIE['user_id'])) {
            header('Location: index.php');
        }

        if (isset($_POST["login"])) {
            $login_sql = "SELECT * from users where user_id = 1;";
            $result = mysqli_query($conn, $login_sql);
            $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $user = $result_set[0];
            setcookie('user_id', $user["user_id"], time() + 3600);
            header('Location: index.php');
        }
    ?>
    <main>
        <form class="login-card" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Please login with your work email!</h2>
            <button name="login">
                <div class="btn-img">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2048px-Google_%22G%22_Logo.svg.png" alt="google_logo" width="40" height="40" />
                </div>
                <span>Login with Google</span>
            </button>
        </form>
    </main>
</body>

</html>