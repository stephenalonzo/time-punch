<?php 

function userPunch($params)
{

	$params = filterParams($params);

	foreach ($_REQUEST as $key => $value)
	{

		switch ($key)
		{

			// Get employee input to determine the type of punch made on the day

			case 'in_day':
			
				$params['dba']['i'] = "INSERT INTO user_punch (user_id, punch_day, in_day, punch_token) VALUES (:user_id, CURDATE(), NOW(), :punch_token)";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{
			
					$status = 'IN';
					updateEmpStatus($params, $status);
			
				}

			break;

			case 'out_break_1':
			
				$params['dba']['i'] = "UPDATE user_punch SET out_break_1 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{
			
					$status = 'OUT_BREAK_1';
					updateEmpStatus($params, $status);
			
				}

			break;

			case 'in_break_1':
			
				$params['dba']['u'] = "UPDATE user_punch SET in_break_1 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{

					$status = 'IN_BREAK_1';
					updateEmpStatus($params, $status);

				}

			break;

			case 'out_lunch':
			
				$params['dba']['i'] = "UPDATE user_punch SET out_lunch = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{
			
					$status = 'OUT_LUNCH';
					updateEmpStatus($params, $status);
			
				}

			break;

			case 'in_lunch':
			
				$params['dba']['u'] = "UPDATE user_punch SET in_lunch = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{

					$status = 'IN_LUNCH';
					updateEmpStatus($params, $status);

				}

			break;

			case 'out_break_2':
			
				$params['dba']['i'] = "UPDATE user_punch SET out_break_2 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{
			
					$status = 'OUT_BREAK_2';
					updateEmpStatus($params, $status);
			
				}

			break;

			case 'in_break_2':
			
				$params['dba']['u'] = "UPDATE user_punch SET in_break_2 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{

					$status = 'IN_BREAK_2';
					updateEmpStatus($params, $status);

				}

			break;

			case 'out_day':
			
				$params['dba']['u'] = "UPDATE user_punch SET out_day = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				dbAccess($params);

			break;

			default:
			break;

		}

	}

				
	return $params;

}

?>