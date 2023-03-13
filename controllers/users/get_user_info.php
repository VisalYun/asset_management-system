<?php
    function get_user_info($conn, $user_id){
        $user_sql = "SELECT * FROM users WHERE user_id=$user_id;";
        $result = mysqli_query($conn, $user_sql);
        $user = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
        return $user;
    }
?>