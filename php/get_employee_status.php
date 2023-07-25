<?php 

function getEmpStatus($params)
{

    // Get employee status to determine if they are in, out for break/lunch or day

	$params = filterParams($params);

	if (isset($_GET['id']) && $_GET['id'])
	{

		$params['dba']['s'] = "SELECT emp_status FROM users WHERE id = :id";
		$params['bindParam'] = array(
			':id'	=> $_GET['id']
		);
	
		$stmt = dbAccess($params);
		$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

	} else {

		$params['dba']['s'] = "SELECT emp_status FROM users WHERE id = :id";
		$params['bindParam'] = array(
			':id'	=> $_SESSION['id']
		);
	
		$stmt = dbAccess($params);
		$params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}

	return $params;

}

?>