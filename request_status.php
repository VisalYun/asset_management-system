<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/request.css">
    <title>Request - Asset Managment System</title>
</head>

<body>
    <?php include 'inc/header.php' ?>
    <?php
    $request_id = $_GET["id"];
    if (empty($request_id)) {
        header("location:index.php");
        return;
    }

    $request_sql = "SELECT * FROM requests WHERE request_id = $request_id";
    $result = mysqli_query($conn, $request_sql);
    $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $request = $result_set[0];

    $user_id = $request["user_id"];
    $user_sql = "SELECT * FROM users WHERE user_id=$user_id;";
    $result = mysqli_query($conn, $user_sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

    $people_sql = "SELECT user_id, user_name FROM users WHERE user_id<>$user_id";
    $result = mysqli_query($conn, $people_sql);
    $people = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $assets_sql = "SELECT * FROM assets;";
    $result = mysqli_query($conn, $assets_sql);
    $assets = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $borrow_date = $request["start_date"];
    $return_date = $request["end_date"];

    $admin_sql = "SELECT user_id, user_name, user_email FROM users WHERE is_admin=1 LIMIT 1;";
    $result = mysqli_query($conn, $admin_sql);
    $approvers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <main>
        <h1>Request Application</h1>
        <section>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-section">
                    <div class="input-group">
                        <label for="name">Name: </label>
                        <input disabled type="text" id="name" name="name" value="<?php echo $user["user_name"] ?>" />
                    </div>
                    <div class="input-group">
                        <label for="behalf-person">On behalf of: </label>
                        <select id="behalf-person" name="behalf-person" disabled>
                            <option value="<?php echo $request["user_id"] ?>" selected="<?php echo (int)$request["owner_id"] == (int)$request["user_id"] ?>">
                                N/A
                            </option>
                            <?php foreach ($people as $person) : ?>
                                <?php if ((int)$request["owner_id"] == (int)$person["user_id"]) : ?>
                                    <option selected="selected">
                                        <?php echo $person["user_name"] ?>
                                    </option>
                                <?php else : ?>
                                    <option>
                                        <?php echo $person["user_name"] ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="asset">Asset to borrow: </label>
                        <select id="asset" name="asset" disabled>
                            <?php foreach ($assets as $item) : ?>
                                <?php if ((int)$request["asset_id"] == (int)$item["asset_id"]) : ?>
                                    <option selected="selected">
                                        <?php echo $item["asset_name"] ?>
                                    </option>
                                <?php else : ?>
                                    <option>
                                        <?php echo $item["asset_name"] ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="start-date">Borrow date: </label>
                        <input type="text" id="start-date" name="start-date" class="start-datepicker" autocomplete="off" value="<?php echo $borrow_date ?>" disabled />
                    </div>
                    <div class="input-group">
                        <label for="end-date">Return date: </label>
                        <input type="text" id="end-date" name="end-date" class="return-datepicker" autocomplete="off" value="<?php echo $return_date ?>" disabled />
                    </div>
                    <div class="input-group">
                        <label for="description">Description: </label>
                        <textarea id="description" name="description" rows="3" disabled><?php echo $request["description"] ?></textarea>
                    </div>
                </div>
                <div class="approver-section">
                    <h2>Approvers</h2>
                    <ul>
                        <?php foreach ($approvers as $approver) : ?>
                            <li id="<?php echo $approver["user_id"] ?>">
                                <?php echo $approver["user_name"] ?>
                                <br />
                                <?php echo $approver["user_email"] ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </form>
            <div class="action-container">
                <div class="action">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="request_id" value="<?php echo $request['request_id'] ?>" />
                        <input type="submit" name="end" value="Return" />
                    </form>
                </div>
                <div class="action">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="request_id" value="<?php echo $request['request_id'] ?>" />
                        <input type="submit" name="cancel" value="Cancel" />
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

</html>