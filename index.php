<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <title>Asset Managment System</title>
</head>

<body>
    <?php include 'inc/header.php' ?>
    <?php
        $total_current_assets_sql = "SELECT COUNT(*) as total from requests where user_id = $user_id and status = 'Active';";
        $result = mysqli_query($conn, $total_current_assets_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_current_assets = $result_set[0]["total"];
        
        $total_pending_requests_sql = "SELECT COUNT(*) as total from requests where user_id = $user_id and is_approved = 0;";
        $result = mysqli_query($conn, $total_pending_requests_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_pending_requests = $result_set[0]["total"];

        $total_approved_requests_sql = "SELECT COUNT(*) as total from requests where user_id = $user_id and is_approved = 1 and status = 'Approved'; ";
        $result = mysqli_query($conn, $total_approved_requests_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_approved_requests = $result_set[0]["total"];

        $asset_sql = "SELECT assets.*, COUNT(requests.request_id) AS number_of_requests, MAX(requests.end_date) AS available_date FROM assets LEFT JOIN requests ON assets.asset_id = requests.asset_id GROUP BY asset_id ORDER BY available_date";
        $result = mysqli_query($conn, $asset_sql);
        $assets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>

    <main>
        <section class="status-bar">
            <div class="status-card">
                <h2>Assets in hand</h2>
                <h3><?php echo $total_current_assets ?></h3>
                <a href="/current_asset.php">View More &#8594;</a>
            </div>
            <div class="status-card pending-request">
                <h2>Pending requests</h2>
                <h3><?php echo $total_pending_requests ?></h3>
                <a href="/pending.php">View More &#8594;</a>
            </div>
            <div class="status-card approved-request">
                <h2>Approved requests</h2>
                <h3><?php echo $total_approved_requests ?></h3>
                <a href="/approved.php">View More &#8594;</a>
            </div>
        </section>
        <section class="assets-list">
            <h2>Current Assets</h2>
            <?php if (empty($assets)) : ?>
                <h3>There is no assets</h3>
            <?php else : ?>
                <table>
                    <tr>
                        <th>Nº</th>
                        <th class="name-col">Name</th>
                        <th>Status</th>
                        <th class="date-col">Availability date</th>
                    </tr>
                    <?php foreach ($assets as $key => $item) : ?>
                        <?php
                        $asset_id = $item["asset_id"];
                        $is_available = ((int)$item["total"] > (int)$item["number_of_requests"]);
                        if ($is_available) {
                            $available_date = "Now";
                        } else {
                            $available_date = $item["available_date"] == NULL ? "Now" : $item["available_date"];
                        }
                        ?>
                        <tr onclick="getAssetDetail(<?php echo $asset_id ?>)">
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $item["asset_name"] ?></td>
                            <?php if ($is_available) : ?>
                                <td><span class="available">Available</span></td>
                            <?php else : ?>
                                <td><span class="unavailable">Not available</span></td>
                            <?php endif; ?>
                            <td><?php echo $available_date ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </section>
    </main>

    <script>
        function getAssetDetail(id) {
            window.location = `/asset.php?id=${id}`;
        }
    </script>
</body>

</html>