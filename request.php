<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/styles/request.css">
    <title>Request - Asset Managment System</title>
</head>

<body>
    <?php include 'inc/header.php' ?>
    <?php
        require_once('./controllers/users/get_user_info.php');
        $user = get_user_info($conn, $user_id);

        require_once('./controllers/users/get_all_users.php');
        $people = get_all_users($conn, $user_id);

        require_once('./controllers/assets/get_all_assets.php');
        $assets = get_all_assets($conn);

        $return_date = date('Y-m-d', strtotime(" +3 days"));

        require_once('./controllers/users/get_admin_user.php');
        $approvers = get_admin_user($conn);

        if (isset($_POST["submit"])) {
            $name = filter_var($user["user_id"], FILTER_SANITIZE_SPECIAL_CHARS);
            $on_behalf_person = filter_input(INPUT_POST, 'behalf-person', FILTER_SANITIZE_SPECIAL_CHARS);
            $on_behalf_person = trim($on_behalf_person) == '' ? $user["user_id"] : $on_behalf_person;
            $borrow_asset = filter_input(INPUT_POST, 'asset', FILTER_SANITIZE_SPECIAL_CHARS);
            $start_date = filter_input(INPUT_POST, 'start-date', FILTER_SANITIZE_SPECIAL_CHARS);
            $end_date = filter_input(INPUT_POST, 'end-date', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            
            require_once('./models/submit_request_dto.php');
            $new_request = new SubmitRequestDto($name, $on_behalf_person, $borrow_asset, $start_date, $end_date, $description);
            require_once('./controllers/requests/submit_request.php');
            $submit_request_result = submit_request($conn, $new_request);
            if ($submit_request_result) {
                header('Location: index.php');
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        }
    ?>
    <main>
        <h1>Request Application</h1>
        <section class="form-container">
            <form class="form-section" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input-group">
                    <label for="name">Name: </label>
                    <input disabled type="text" id="name" name="name" value="<?php echo $user["user_name"] ?>" />
                </div>
                <div class="input-group">
                    <label for="behalf-person">On behalf of: </label>
                    <select id="behalf-person" name="behalf-person">
                        <option value="">N/A</option>
                        <?php foreach ($people as $person) : ?>
                            <option value="<?php echo $person["user_id"] ?>"><?php echo $person["user_name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <?php

                ?>
                <div class="input-group">
                    <label for="asset">Asset to borrow: </label>
                    <select id="asset" name="asset">
                        <option value="">Please Choose...</option>
                        <?php foreach ($assets as $item) : ?>
                            <option value="<?php echo $item["asset_id"] ?>"><?php echo $item["asset_name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="start-date">Borrow date: </label>
                    <input type="text" id="start-date" name="start-date" class="start-datepicker" autocomplete="off" />
                </div>
                <div class="input-group">
                    <label for="end-date">Return date: </label>
                    <input type="text" id="end-date" name="end-date" class="return-datepicker" autocomplete="off" />
                </div>
                <div class="input-group">
                    <label for="description">Description: </label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>
                <div class="input-group">
                    <input type="submit" name="submit" class="primary-btn" />
                </div>
            </form>
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
        </section>
    </main>

    <script>
        $(function() {
            function onAssetSelect() {
                $(".start-datepicker").val('');
                $(".start-datepicker").datepicker("destroy");
                $.ajax({
                    type: "GET",
                    url: "/utilities/get_unavailable_date.php",
                    data: "asset_id=" + this.value,
                    success: function(result) {
                        var unavailable_date = result
                        $(".start-datepicker").datepicker({
                            minDate: 0,
                            beforeShowDay: function(date) {
                                var string = jQuery.datepicker.formatDate('yy-mm-dd', date)
                                return [unavailable_date.indexOf(string) == -1]
                            },
                            onSelect: function() {
                                onBorrowedDateSelect(this.value, unavailable_date)
                            }
                        });
                    }
                });
            }

            function onBorrowedDateSelect(date, unavailable_date) {
                $(".return-datepicker").val('');
                $(".return-datepicker").datepicker("destroy");
                borrow_date_arr = date.split("/")
                borrow_date = new Date(parseInt(borrow_date_arr[2]), parseInt(borrow_date_arr[0]) - 1, parseInt(borrow_date_arr[1]))

                temp = JSON.parse(unavailable_date)
                for (var i = 0; i < temp.length; i++) {
                    next_requested_date = temp[i].split("-")
                    next_requested_date = new Date(parseInt(next_requested_date[0]), parseInt(next_requested_date[1]) - 1, parseInt(next_requested_date[2]))
                    if (borrow_date < next_requested_date) {
                        $(".return-datepicker").datepicker({
                            minDate: borrow_date,
                            maxDate: next_requested_date,
                            beforeShowDay: function(date) {
                                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                                return [unavailable_date.indexOf(string) == -1]
                            }
                        });
                        return
                    }
                }

                $(".return-datepicker").datepicker({
                    minDate: borrow_date,
                    beforeShowDay: function(date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [unavailable_date.indexOf(string) == -1]
                    }
                });
            }

            $('#asset').on('change', onAssetSelect);
        });
    </script>
</body>

</html>