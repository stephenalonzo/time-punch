<?php 

function timeOffRequest($params)
{

    $params = filterParams($params);
    $params = getAccrual($params);

    // Get user input from time off request form
    // Submit to database

    foreach ($params['results'] as $row)
    {

        if ($params['timeoff_hours'] <= $row['accrual'])
        {

            $params['dba']['i'] = "INSERT INTO time_off_request (user_id, timeoff_start, timeoff_end, reason_for_leave) VALUES (:user_id, :timeoff_start, :timeoff_end, :reason_for_leave)";
            $params['bindParam'] = array(
                ':user_id'  => $_SESSION['id'],
                ':timeoff_start'    => date('Y-m-d', strtotime($params['timeoff_start'])),
                ':timeoff_end'  => date('Y-m-d', strtotime($params['timeoff_end'])),
                ':reason_for_leave' => $params['timeoff_reason']
            );

            if (dbAccess($params))
            {

                $params['dba']['i'] = "INSERT INTO user_punch (user_id, punch_day, total_hours, punch_token) VALUES (:user_id, :punch_day, :total_hours, :punch_token)";
                $params['bindParam'] = array(
                    ':user_id' 		=> $_SESSION['id'],
                    ':punch_day'    => date('Y-m-d', strtotime($params['timeoff_start'])),
                    ':total_hours'  => $params['timeoff_hours'],
                    ':punch_token'	=> 'ON_LEAVE'
                );
    
                if (dbAccess($params))
                {

                    $params['new_accrual'] = $row['accrual'] - $params['timeoff_hours'];

                    $params['dba']['u'] = "UPDATE accrual_bank SET accrual = :accrual WHERE user_id = :user_id";
                    $params['bindParam'] = array(
                        ':accrual'  => $params['new_accrual'],
                        ':user_id'  => $_SESSION['id']
                    );

                    dbAccess($params);

                }

            }

        }

    }

    return $params;

}

?>