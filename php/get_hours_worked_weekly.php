<?php 

function getHoursWorkedWeekly($params)
{

	$params = filterParams($params);

	// Get the total hours worked if the employee selects a specific pay-period

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
	
			if (isset($_GET['id']) && $_GET['id'])
			{

				$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day BETWEEN :pp_start AND :pp_end";
				$params['bindParam'] = array(
					':user_id'	=> $_GET['id'],
					':pp_start'	=> $row['pp_start'],
					':pp_end'	=> $row['pp_end']
				);
				
			} else {

				$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day BETWEEN :pp_start AND :pp_end";
				$params['bindParam'] = array(
					':user_id'	=> $_SESSION['id'],
					':pp_start'	=> $row['pp_start'],
					':pp_end'	=> $row['pp_end']
				);

			}
	
		}

	} else {

		// Default will be able to view the total hours worked in the current pay-period

		$params['dba']['s'] = "SELECT * FROM pay_period WHERE id = :id";
		$params['bindParam'] = array(
			':id'	=> $_SESSION['pay_period']
		);
	
		$stmt = dbAccess($params);
		$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($params['results'] as $row)
		{
	
			if (isset($_GET['id']) && $_GET['id'])
			{

				$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day BETWEEN :pp_start AND :pp_end";
				$params['bindParam'] = array(
					':user_id'	=> $_GET['id'],
					':pp_start'	=> $row['pp_start'],
					':pp_end'	=> $row['pp_end']
				);

			} else {

				$params['dba']['s'] = "SELECT * FROM user_punch WHERE user_id = :user_id AND punch_day BETWEEN :pp_start AND :pp_end";
				$params['bindParam'] = array(
					':user_id'	=> $_SESSION['id'],
					':pp_start'	=> $row['pp_start'],
					':pp_end'	=> $row['pp_end']
				);

			}
	
		}

	}

	$stmt = dbAccess($params);
	$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $params;

}

?>