<?php 

function userPunchData($params)
{

	$params = filterParams($params);

	// Get employee punch data to build out timesheet

	// Create sequence if user decides to view their timesheet under a specific pay-period

	if (isset($params['pay_period']))
	{

		$params['dba']['s'] = "SELECT * FROM pay_period WHERE id = :id";
		$params['bindParam'] = array(
			':id'	=> $params['pay_period']
		);
	
		$stmt = dbAccess($params);
		$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		foreach ($params['results'] as $row)
		{
	
			$pp_start = date('Y-m-d', strtotime($row['pp_start']));
			$pp_end = date('Y-m-d', strtotime($row['pp_end']));

			$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day BETWEEN '$pp_start' AND '$pp_end'";
			$params['bindParam'] = array(
				':user_id'	=> $_SESSION['id']
			);
		
			$stmt = dbAccess($params);
			$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
		}

	} else {

		// Create sequence to display timesheet under current pay-period

		$params['dba']['s'] = "SELECT * FROM pay_period WHERE id = :id";
		$params['bindParam'] = array(
			':id'	=> $_SESSION['pay_period']
		);

		$stmt = dbAccess($params);
		$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($params['results'] as $row)
		{
			
			$pp_start = date('Y-m-d', strtotime($row['pp_start']));
			$pp_end = date('Y-m-d', strtotime($row['pp_end']));

			$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day BETWEEN '$pp_start' AND '$pp_end'";
			$params['bindParam'] = array(
				':user_id'	=> $_SESSION['id']
			);
		
			$stmt = dbAccess($params);
			$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

	}
	
	return $params;

}

?>