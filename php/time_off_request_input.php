<?php 

function timeOffRequest($params)
{

    $params = filterParams($params);

    // Get user input from time off request form
    // Submit to database

    $params['dba']['i'] = "INSERT INTO time_off_request (user_id, emp_name, timeoff_start, timeoff_end, reason_for_leave, timeoff_hours, timeoff_status) VALUES (:user_id, :emp_name, :timeoff_start, :timeoff_end, :reason_for_leave, :timeoff_hours, :timeoff_status)";
    $params['bindParam'] = array(
        ':user_id'  => $_SESSION['id'],
        ':emp_name' => $_SESSION['first_name'].' '.$_SESSION['last_name'],
        ':timeoff_start'    => date('Y-m-d', strtotime($params['timeoff_start'])),
        ':timeoff_end'  => date('Y-m-d', strtotime($params['timeoff_end'])),
        ':reason_for_leave' => $params['timeoff_reason'],
        ':timeoff_hours'    => $params['timeoff_hours'],
        ':timeoff_status'   => 'PENDING'
    );

    dbAccess($params);

    return $params;

}

?>