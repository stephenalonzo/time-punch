<?php 

function totalHoursPunch($params)
{

    $params = filterParams($params);

    $params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
    $params['bindParam'] = array(
        ':emp_status' => 'OUT',
        ':id'	=> $_SESSION['id']
    );
    
    if (dbAccess($params))
    {

        // Calculate the total hours worked on the day of in punch
    
        $params['results'] = getHoursWorkedToday($params);
        $hours = 0;
        $sum_breaks_1 = 0;
        $sum_breaks_2 = 0;
        $sum_lunch = 0;
    
        foreach ($params['results'] as $row)
        {
    
            $start = strtotime( $row[ 'in_day' ] );
            $out_break_1 = strtotime( $row['out_break_1']);
            $in_break_1 = strtotime( $row['in_break_1']);
            $out_lunch = strtotime( $row['out_lunch']);
            $in_lunch = strtotime( $row['in_lunch']);
            $out_break_2 = strtotime( $row['out_break_2']);
            $in_break_2 = strtotime( $row['in_break_2']);
            $stop = strtotime( $row[ 'out_day' ]);
            $sum_breaks_2 += ($in_break_2 - $out_break_2) / 3600;
            $sum_breaks_1 += ($in_break_1 - $out_break_1) / 3600;
            $sum_lunch += ($in_lunch - $out_lunch) / 3600;
            $total = $hours + ($stop - $start) / 3600;
    
        }
    
        $total_hours = $total - ($sum_breaks_1 + $sum_breaks_2 + $sum_lunch);
    
        $params['dba']['u'] = "UPDATE user_punch SET total_hours = :total_hours WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
        $params['bindParam'] = array(
            ':user_id' 		=> $_SESSION['id'],
            ':total_hours'	=> round($total_hours, 2),
            ':punch_token'	=> $_SESSION['punch_token']
        );
    
        dbAccess($params);
    
    }

    return $params;

}

?>