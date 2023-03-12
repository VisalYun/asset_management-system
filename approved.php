<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/current_asset.css">
    <title>Current Asset - Asset Managment System</title>
</head>

<body>
    <?php include 'inc/header.php' ?>
    <?php
        $total_approved_requests_sql = "SELECT requests.*, assets.asset_name from requests INNER JOIN assets on requests.asset_id = assets.asset_id where owner_id = $user_id and is_approved = 1 and status = 'Approved' and is_deleted = 0;";
        $result = mysqli_query($conn, $total_approved_requests_sql);
        $request_transaction = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <main>
        <section class="current-asset">
            <h1>Approved Request</h1>
            <?php if (empty($request_transaction)) : ?>
                <h3>There is no approved request and waiting to delivered right now.</h3>
            <?php else : ?>
                <table>
                    <tr>
                        <th>Nº</th>
                        <th class="name-col">Name</th>
                        <th class="date-col">Requested date</th>
                        <th class="date-col">Approved date</th>
                        <th class="date-col">Delivered date</th>
                    </tr>
                    <?php foreach($request_transaction as $key => $item): ?>
                        <?php $request_id = $item["request_id"] ?>
                        <tr onclick="getRequestDetail(<?php echo $request_id ?>)">
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $item["asset_name"] ?></td>
                            <td><?php echo $item["created_date"] ?></td>
                            <td><?php echo $item["approved_date"] ?></td>
                            <td><?php echo $item["start_date"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </section>
    </main>

    <script>
        function getRequestDetail(id) {
            window.location = `/request_status.php?id=${id}`;
        }
    </script>
</body>

</html>