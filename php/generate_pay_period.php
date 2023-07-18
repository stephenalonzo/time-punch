<?php 

function generatePayPeriod($params)
{

	$params = filterParams($params);

	$params['dba']['s'] = "SELECT pp_end FROM pay_period ORDER BY id DESC LIMIT 1";
	$stmt = dbAccess($params);
	
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($results as $row)
	{

        // Generate next pay-period after the last day of the pay-period

		if (date('Y-m-d', strtotime($row['pp_end'])) < date('Y-m-d'))
		{

			$params['dba']['i'] = "INSERT INTO pay_period (pp_start, pp_end) VALUES (:pp_start, :pp_end)";
			$params['bindParam'] = array(
				':pp_start'	=> date('Y-m-d', strtotime($row['pp_end'] . '+ 1 day')),
				':pp_end'	=> date('Y-m-d', strtotime($row['pp_end'] . '+ 14 days'))
			);
			
			// Grant employee 2 hours, which will apply to their accrual
			// These hours will be utilized for PTO

			if (dbAccess($params))
			{

				$params['dba']['u'] = "UPDATE accrual_bank SET accrual = :accrual WHERE user_id = :user_id";
				$params['bindParam'] = array(
					':accrual'	=> 2,
					':user_id'	=> $_SESSION['id']
				);

				dbAccess($params);

			}

		}

	}

	return $params;

}

?>