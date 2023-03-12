<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/request.css">
    <title>Asset Detail - Asset Managment System</title>
</head>

<body>
    <?php include 'inc/header.php' ?>
    <?php
        $id = $_GET['id'];
        if (empty($id)) {
            header("location:index.php");
            return;
        }

        $asset_sql = "SELECT assets.*, COUNT(requests.request_id) AS number_of_requests, MAX(requests.end_date) AS available_date FROM assets LEFT JOIN requests ON assets.asset_id = requests.asset_id WHERE assets.asset_id = '$id' AND requests.status <> 'Return' GROUP BY asset_id";
        $result = mysqli_query($conn, $asset_sql);
        $assets = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $current_asset = $assets[0];
        if (empty($current_asset)) {
            header("location:index.php");
            return;
        }

        $added_date = explode(" ", $current_asset["created_date"])[0];
        $total = $current_asset["total"];
        $available = (int)$current_asset["total"] - (int)$current_asset["number_of_requests"];
        $is_available = $available > 0;
        $available_date = $current_asset["available_date"] == NULL ? "Now" : $current_asset["available_date"];
    ?>
    <main>
        <h1><?php echo $current_asset["asset_name"] ?></h1>
        <section class="form-container">
            <form class="form-section" action="/index.html" method="get">
                <div class="input-group">
                    <label for="name">Name: </label>
                    <input disabled type="text" id="name" name="name" value="<?php echo $current_asset["asset_name"] ?>" />
                </div>
                <div class="input-group">
                    <label for="total-stock">Total in stock: </label>
                    <input disabled type="text" id="total-stock" name="total-stock" value="<?php echo $total ?>" />
                </div>
                <div class="input-group">
                    <label for="added-date">Added date: </label>
                    <input disabled type="date" id="added-date" name="added-date" value="<?php echo $added_date ?>" />
                </div>
                <div class="input-group">
                    <label for="description">Description: </label>
                    <textarea disabled id="description" name="description" rows="3"><?php echo $current_asset["description"] ?></textarea>
                </div>
            </form>
            <div class="approver-section">
                <h2><u>Status</u></h2>
                <?php if ($is_available) : ?>
                    <p class="status-badge available">Available <?php echo "$available/$total" ?></p>
                <?php else : ?>
                    <p class="status-badge unavailable">Not Available</p>
                <?php endif; ?>
                
                <h2><u>Available date</u></h2>
                <?php if ($is_available) : ?>
                    <p class="date-bold">Now</p>
                <?php else : ?>
                    <p class="date-bold"><?php echo $available_date ?></p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>

</html>