<?php
    $assets = [
        [
            "id" => 1,
            "name" => "Car",
            "physical_id" => "0283939",
            "model" => "Tesla",
            "total" => 1,
            "added_date" => "2023-03-03",
            "description" => "This is car",
            "is_available" => true,
            "available_date" => "Now"
        ],
        [
            "id" => 2,
            "name" => "iMac",
            "physical_id" => "4859392",
            "model" => "iMac",
            "total" => 1,
            "added_date" => "2023-03-03",
            "description" => "This is iMac",
            "is_available" => false,
            "available_date" => "03/03/2023 11:00:00"
        ]
    ];

    $id = $_GET['id'];
    if(empty($id)){
        header("location:index.php");
    }

    $current_asset = [];
    foreach($assets as $asset){
        if($asset["id"] == $id){
            $current_asset = $asset;
            break;
        }
    }
    if(empty($current_asset)){
        header("location:index.php");
    }
?>

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
    <main>
        <h1><?php echo $current_asset["name"] ?></h1>
        <section>
            <form action="/index.html" method="get">
                <div class="form-section">
                    <div class="input-group">
                        <label for="name">Name: </label>
                        <input disabled type="text" id="name" name="name" value="<?php echo $current_asset["name"] ?>" />
                    </div>
                    <div class="input-group">
                        <label for="physical-id">Physical Id: </label>
                        <input disabled type="text" id="physical-id" name="physical-id" value="<?php echo $current_asset["physical_id"] ?>" />
                    </div>
                    <div class="input-group">
                        <label for="model">Model: </label>
                        <input disabled type="text" id="model" name="model" value="<?php echo $current_asset["model"] ?>" />
                    </div>
                    <div class="input-group">
                        <label for="total-stock">Total in stock: </label>
                        <input disabled type="text" id="total-stock" name="total-stock" value="<?php echo $current_asset["total"] ?>" />
                    </div>
                    <div class="input-group">
                        <label for="added-date">Added date: </label>
                        <input disabled type="date" id="added-date" name="added-date" value="<?php echo $current_asset["added_date"] ?>" />
                    </div>
                    <div class="input-group">
                        <label for="description">Description: </label>
                        <textarea disabled id="description" name="description" rows="3"><?php echo $current_asset["description"] ?></textarea>
                    </div>
                </div>
                <div class="approver-section">
                    <h2><u>Status</u></h2>
                    <?php if($current_asset["is_available"]): ?>
                        <p class="status-badge available">Available (1/1)</p>
                    <?php else: ?>
                        <p class="status-badge unavailable">Not Available</p>
                    <?php endif; ?>
                    <h2><u>Available date</u></h2>
                    <p class="date-bold"><?php echo $current_asset["available_date"] ?></p>
                </div>
            </form>
        </section>
    </main>
</body>

</html>