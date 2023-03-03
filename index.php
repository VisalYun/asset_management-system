<?php
$total_current_assets = 0;
$total_pending_requests = 0;
$total_approved_requests = 0;
$asset = [
    [
        "id" => 1,
        "name" => "Car",
        "physical_id" => "0283939",
        "model" => "Tesla",
        "total" => 1,
        "added_date" => "01/01/2023 12:00:00",
        "description" => "This is car",
        "isAvailable" => true,
        "availableDate" => "Now"
    ],
    [
        "id" => 2,
        "name" => "iMac",
        "physical_id" => "4859392",
        "model" => "iMac",
        "total" => 1,
        "added_date" => "01/01/2023 12:00:00",
        "description" => "This is iMac",
        "isAvailable" => false,
        "availableDate" => "03/03/2023 11:00:00"
    ]
];
?>

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
            <?php if (empty($asset)) : ?>
                <h3>There is no assets</h3>
            <?php else : ?>
                <table>
                    <tr>
                        <th>Nº</th>
                        <th class="name-col">Name</th>
                        <th>Status</th>
                        <th class="date-col">Availability date</th>
                    </tr>
                    <?php foreach ($asset as $item) : ?>
                        <?php $asset_id = $item["id"] ?>
                        <tr onclick="getAssetDetail(<?php echo $asset_id ?>)">
                            <td><?php echo $asset_id ?></td>
                            <td><?php echo $item["name"] ?></td>
                            <?php if($item["isAvailable"]): ?>
                                <td><span class="available">Available</span></td>
                            <?php else: ?>
                                <td><span class="unavailable">Not available</span></td>
                            <?php endif; ?>
                            <td><?php echo $item["availableDate"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </section>
    </main>
    
    <script>
        function getAssetDetail(id){
            window.location = `/asset.php?id=${id}`;
        }
    </script>
</body>
</html>