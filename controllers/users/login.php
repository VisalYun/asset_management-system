<?php
    function login($conn, $user_id){
        $login_sql = "SELECT * from users where user_id = $user_id;";
        $result = mysqli_query($conn, $login_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_set[0];
    }
?>