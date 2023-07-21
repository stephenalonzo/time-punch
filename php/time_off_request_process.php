<?php 

function timeOffRequestProcess($params)
{

    $params = filterParams($params);
    $tor = getTimeOffRequest($params);
    
    foreach ($_REQUEST as $key => $value)
    {

        // Determine what the admin's decision for the time-off request
        // timeoff_approve = APPROVED | timeoff_deny = DENIED

        switch ($key)
        {

            case 'timeoff_approve':
                $params['dba']['u'] = "UPDATE time_off_request SET timeoff_status = :timeoff_status WHERE user_id = :user_id";
                $params['bindParam'] = array(
                    ':timeoff_status'   => 'APPROVED',
                    ':user_id'  => $params['user_id']
                );
            
                if (dbAccess($params))
                {
        
                    foreach ($tor['results'] as $row)
                    {
        
                        $params['timeoff_hours'] = $row['timeoff_hours'];
                        $params['timeoff_start'] = $row['timeoff_start'];
        
                        $user_id = $params['user_id'];
                        $acc = getAccrual($params, $user_id);
                        
                        foreach ($acc['results'] as $row)
                        {

                            // Update employee's total accrual
        
                            if ($params['timeoff_hours'] <= $row['accrual'])
                            {
                        
                                $params['new_accrual'] = $row['accrual'] - $params['timeoff_hours'];
                
                                $params['dba']['u'] = "UPDATE accrual_bank SET accrual = :accrual WHERE user_id = :user_id";
                                $params['bindParam'] = array(
                                    ':accrual'  => $params['new_accrual'],
                                    ':user_id'  => $params['user_id']
                                );
                    
                                dbAccess($params);
                
                            }
        
                        }
        
                        // Create a punch record to show PTO in employee's timesheet
                        
                        $params['dba']['i'] = "INSERT INTO user_punch (user_id, punch_day, total_hours, punch_token) VALUES (:user_id, :punch_day, :total_hours, :punch_token)";
                        $params['bindParam'] = array(
                            ':user_id' 		=> $params['user_id'],
                            ':punch_day'    => date('Y-m-d', strtotime($params['timeoff_start'])),
                            ':total_hours'  => $params['timeoff_hours'],
                            ':punch_token'	=> 'ON_LEAVE'
                        );
        
                        dbAccess($params);
            
                    }
        
                }
            break;

            case 'timeoff_deny':
                $params['dba']['u'] = "UPDATE time_off_request SET timeoff_status = :timeoff_status WHERE user_id = :user_id";
                $params['bindParam'] = array(
                    ':timeoff_status' => 'DENIED',
                    ':user_id'  => $params['user_id']
                );

                dbAccess($params);
            break;

        }

    }

    return $params;

}

function deleteTimeOffRequest($params)
{

    $params = filterParams($params);

    $params['dba']['s'] = "SELECT * FROM time_off_request WHERE user_id = :user_id";
    $params['bindParam'] = array(
        ':user_id'  => $params['user_id']
    );

    $stmt = dbAccess($params);
    $params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If time-off request is denied, delete time-off request record

    foreach ($params['results'] as $row)
    {

        if (date('Y-m-d') > date('Y-m-d', strtotime($row['timeoff_request_created_at'])))
        {

            $params['dba']['d'] = "DELETE FROM time_off_request WHERE user_id = :user_id";
            $params['bindParam'] = array(
                ':user_id'  => $params['user_id']
            );

            dbAccess($params);
            
        }

    }

    return $params;

}

?>