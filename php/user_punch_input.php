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
			
					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'IN',
						':id'	=> $_SESSION['id']
					);
					
					dbAccess($params);
			
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
			
					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'OUT_BREAK_1',
						':id'	=> $_SESSION['id']
					);
					
					dbAccess($params);
			
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

					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'IN_BREAK_1',
						':id'	=> $_SESSION['id']
					);
				
					dbAccess($params);

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
			
					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'OUT_LUNCH',
						':id'	=> $_SESSION['id']
					);
					
					dbAccess($params);
			
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

					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'IN_LUNCH',
						':id'	=> $_SESSION['id']
					);
				
					dbAccess($params);

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
			
					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'OUT_BREAK_2',
						':id'	=> $_SESSION['id']
					);
					
					dbAccess($params);
			
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

					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'IN_BREAK_2',
						':id'	=> $_SESSION['id']
					);
				
					dbAccess($params);

				}

			break;

			case 'out_day':
			
				$params['dba']['u'] = "UPDATE user_punch SET out_day = NOW() WHERE user_id = :user_id AND punch_day = CURDATE() AND punch_token = :punch_token";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_token'	=> $_SESSION['punch_token']
				);
			
				if (dbAccess($params))
				{

					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'OUT',
						':id'	=> $_SESSION['id']
					);
				
					if (dbAccess($params))
					{

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

				}

			break;

			default:
			break;

		}

	}

				
	return $params;

}

?>