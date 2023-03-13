<?php
    function get_all_assets($conn){
        $assets_sql = "SELECT * FROM assets;";
        $result = mysqli_query($conn, $assets_sql);
        $assets = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $assets;
    }
?>