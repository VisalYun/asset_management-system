<?php
    function cancel_request($conn, $user_id, $request_id){
        $current_date = date("Y-m-d h:m:s");
        $cancel_sql = "UPDATE requests SET is_deleted = 1, modifies_date = '$current_date', modifies_user = $user_id WHERE request_id = $request_id;";
        $result = mysqli_query($conn, $cancel_sql);
        return $result;
    }
?>