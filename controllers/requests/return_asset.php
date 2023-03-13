<?php
    function return_asset($conn, $user_id, $request_id){
        $current_date = date("Y-m-d h:m:s");
        $return_sql = "UPDATE requests SET status = 'Return', modifies_date = '$current_date', modifies_user = $user_id WHERE request_id = $request_id;";
        $result = mysqli_query($conn, $return_sql);
        return $result;
    }
?>