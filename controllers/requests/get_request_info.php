<?php
    function get_request_info($conn, $request_id){
        $request_sql = "SELECT * FROM requests WHERE request_id = $request_id";
        $result = mysqli_query($conn, $request_sql);
        $result_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result_set[0];
    }
?>