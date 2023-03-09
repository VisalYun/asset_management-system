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
        $total_current_assets_sql = "SELECT requests.*, assets.asset_name from requests INNER JOIN assets on requests.asset_id = assets.asset_id where user_id = $user_id and status = 'Active';";
        $result = mysqli_query($conn, $total_current_assets_sql);
        $request_transaction = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <main>
        <section class="current-asset">
            <h1>Current assets in your possession</h1>
            <?php if (empty($request_transaction)) : ?>
                <h3>There is no assets in your hand right now.</h3>
            <?php else : ?>
                <table>
                    <tr>
                        <th>Nº</th>
                        <th class="name-col">Name</th>
                        <th class="date-col">Requested date</th>
                        <th class="date-col">Borrowed date</th>
                        <th class="date-col">Returned date</th>
                    </tr>
                    <?php foreach ($request_transaction as $key => $item) : ?>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo $item["asset_name"] ?></td>
                            <td><?php echo $item["created_date"] ?></td>
                            <td><?php echo $item["start_date"] ?></td>
                            <td><?php echo $item["end_date"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>