<?php
    function get_admin_user($conn){
        $admin_sql = "SELECT user_id, user_name, user_email FROM users WHERE is_admin=1 LIMIT 1;";
        $result = mysqli_query($conn, $admin_sql);
        $admin_user = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $admin_user;
    }
?>