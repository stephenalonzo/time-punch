<?php 

function userLogin($params)
{

	$params = filterParams($params);

	$params['dba']['s'] = "SELECT * FROM users WHERE username = :username AND password = :password";
	$params['bindParam'] = array(
		':username' => $params['username'],
		':password'	=> $params['password']
	);

	$stmt = dbAccess($params);
	$results = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($results['username'] == $params['username'])
	{

		session_start();

		// Set user session data

		$_SESSION['id']			= $results['id'];
		$_SESSION['first_name']	= $results['first_name'];
		$_SESSION['last_name']	= $results['last_name'];

		header("Location: index.php");

		if ($results['emp_status'] == 'OUT')
		{

			// Generate a punch token to identify where punch data will be added for the employee's timesheet

			$params['punch_token'] = bin2hex(random_bytes(5));

			$params['dba']['u'] = "UPDATE users SET punch_token = :punch_token WHERE id = :id";
			$params['bindParam'] = array(
				':id'	=> $_SESSION['id'],
				':punch_token'	=> $params['punch_token']
			);

			dbAccess($params);

			$_SESSION['punch_token'] = $params['punch_token'];

		} else {

			$_SESSION['punch_token'] = $results['punch_token'];

		}

	} else {

		header("Location: login.php");
		
	}

	return $params;

}

function userLogout()
{

	session_start();
	session_destroy();

	header("Location: login.php");

}

?>