<?php 

function getHoursWorkedToday($params)
{

	$params = filterParams($params);

    // Get the employee's total hours worked on the day
	
	$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
	$params['bindParam'] = array(
		':user_id'	=> $_SESSION['id'],
		':punch_token'	=> $_SESSION['punch_token']
	);

	$stmt = dbAccess($params);
	$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $params;

}

?>