<?php 
    define("DB_HOST", "146.190.97.61");
    define("DB_USER", "app_user");
    define("DB_PASS", "zq4odp]J*8!JFwIe");
    define("DB_NAME", "asset_managment_system");
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $id = $_GET['asset_id'];
    $total_sql = "SELECT total from assets WHERE asset_id = $id";
    $result = mysqli_query($conn, $total_sql);
    $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $total_assets = $result_set[0]["total"];

    $sql = "SELECT start_date, end_date FROM requests WHERE asset_id = $id and is_deleted = 0;";
    $result = mysqli_query($conn, $sql);
    $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(count($result_set) < $total_assets){
        echo json_encode([]);
        return;
    }

    $unavailable_date = [];
    foreach($result_set as $date){
        $start_date = explode(" ", $date["start_date"])[0];
        $end_date = explode(" ", $date["end_date"])[0];
        if($start_date == $end_date){
            array_push($unavailable_date, $start_date);
            continue;
        }
        
        $temp = $start_date;
        array_push($unavailable_date, $temp);
        while($temp < $end_date){
            $temp = date('Y-m-d', strtotime($temp." + 1 days"));
            array_push($unavailable_date, $temp);
        }
    }

    echo json_encode($unavailable_date);
?>