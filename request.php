<?php
    $username = "John Doe";
    $people = ["Jane Doe", "Mary Doe"];
    $assets = ["Car"];
    $return_date = date('Y-m-d', strtotime(" +3 days"));

    if(isset($_POST["submit"])){
        $name = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        $on_behalf_person = filter_input(INPUT_POST, 'behalf-person', FILTER_SANITIZE_SPECIAL_CHARS);
        $borrow_asset = filter_input(INPUT_POST, 'asset', FILTER_SANITIZE_SPECIAL_CHARS);
        $start_date = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $end_date = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

        echo "$name, $on_behalf_person, $borrow_asset, $start_date, $end_date, $description";
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
    <title>Request - Asset Managment System</title>
</head>

<body>
    <?php include 'inc/header.php' ?>
    <main>
        <h1>Request Application</h1>
        <section>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-section">
                    <div class="input-group">
                        <label for="name">Name: </label>
                        <input disabled type="text" id="name" name="name" value="<?php echo $username ?>" />
                    </div>
                    <div class="input-group">
                        <label for="behalf-person">On behalf of: </label>
                        <select id="behalf-person" name="behalf-person">
                            <option value="">N/A</option>
                            <?php foreach($people as $person): ?>
                                <option><?php echo $person ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="asset">Asset to borrow: </label>
                        <select id="asset" name="asset">
                            <option value="">Please Choose...</option>
                            <?php foreach($assets as $item): ?>
                                <option><?php echo $item ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="start-date">Borrow date: </label>
                        <input type="date" id="start-date" name="start-date" value="<?php echo date("Y-m-d") ?>" />
                    </div>
                    <div class="input-group">
                        <label for="end-date">Return date: </label>
                        <input type="date" id="end-date" name="end-date" value="<?php echo $return_date ?>" />
                    </div>
                    <div class="input-group">
                        <label for="description">Description: </label>
                        <textarea id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="input-group">
                        <input type="submit" name="submit" class="primary-btn" />
                    </div>
                </div>
                <div class="approver-section">
                    <h2>Approvers</h2>
                    <ul>
                        <li>Admin<br />admin@corporation.com</li>
                    </ul>
                </div>
            </form>
        </section>
    </main>
</body>

</html>