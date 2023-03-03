<?php
$request_transaction = [
    [
        "id" => 1,
        "asset_name" => "iMac",
        "request_date" => "22/02/2023 15:00:00",
        "borrowed_date" => "23/02/2023 12:00:00",
        "returned_date" => "27/02/2023 15:00:00",
        "is_approved" => true,
        "approved_date" => "22/02/2023 17:00:00",
        "delivered_date" => "23/02/2023 12:00:00",
    ]
]
?>

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
                    <?php foreach ($request_transaction as $item) : ?>
                        <tr>
                            <td><?php echo $item["id"] ?></td>
                            <td><?php echo $item["asset_name"] ?></td>
                            <td><?php echo $item["request_date"] ?></td>
                            <td><?php echo $item["borrowed_date"] ?></td>
                            <td><?php echo $item["returned_date"] ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>