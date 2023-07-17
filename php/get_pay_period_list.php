<?php 

function getPayPeriods($params)
{

	// Get list of pay-periods

	$params = filterParams($params);

	$params['dba']['s'] = "SELECT * FROM pay_period ORDER BY pp_end DESC";

	$stmt = dbAccess($params);
	$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $params['results'];

}

?>