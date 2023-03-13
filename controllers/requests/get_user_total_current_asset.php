<?php
    function get_user_total_current_assets($conn, $user_id){
        $total_current_assets_sql = "SELECT COUNT(*) as total from requests where owner_id = $user_id and status = 'Active' and is_deleted = 0;";
        $result = mysqli_query($conn, $total_current_assets_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_set[0]["total"];
    }
?>