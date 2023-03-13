<?php
    function get_user_total_approved_request($conn, $user_id){
        $total_approved_requests_sql = "SELECT COUNT(*) as total from requests where owner_id = $user_id and is_approved = 1 and status = 'Approved' and is_deleted = 0;";
        $result = mysqli_query($conn, $total_approved_requests_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_set[0]["total"];
    }
?>