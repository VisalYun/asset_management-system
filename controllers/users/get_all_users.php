<?php
    function get_all_users($conn, $user_id){
        $people_sql = "SELECT user_id, user_name FROM users WHERE user_id<>$user_id";
        $result = mysqli_query($conn, $people_sql);
        $people = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $people;
    }
?>