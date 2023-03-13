<?php
    function submit_request($conn, $new_request){
        $submit_request_sql = "INSERT INTO requests (user_id, asset_id, owner_id, start_date, end_date, description) VALUES ($new_request->name, $new_request->borrow_asset, $new_request->on_behalf_person, STR_TO_DATE(\"$new_request->start_date\", \"%m/%d/%Y\"), STR_TO_DATE(\"$new_request->end_date\", \"%m/%d/%Y\"), '$new_request->description')";
        $result = mysqli_query($conn, $submit_request_sql);
        return $result;
    }
?>