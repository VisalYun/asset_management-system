<?php
    function get_user_total_pending_request($conn, $user_id){
        $total_pending_requests_sql = "SELECT COUNT(*) as total from requests where owner_id = $user_id and is_approved = 0 and is_deleted = 0;";
        $result = mysqli_query($conn, $total_pending_requests_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_set[0]["total"];
    }
?>