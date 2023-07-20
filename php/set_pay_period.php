<?php 

function setPayPeriod($params)
{

	$params['dba']['s'] = "SELECT * FROM pay_period WHERE CURDATE() BETWEEN pp_start AND pp_end";
		
	$stmt = dbAccess($params);
	$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($params['results'] as $row)
	{

        // Set the pay-period

		$_SESSION['pay_period'] = $row['id'];

	}

	return $params;
	
}

?>