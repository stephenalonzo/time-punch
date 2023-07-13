<?php 

function dbAccess($params)
{

    try {
    
        $pdo = new PDO("mysql:host=localhost;dbname=timepunch", 'root', '');

        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($params['dba'] as $key => $value)
        {

            $stmt = $pdo->prepare($params['dba'][$key]);

        }

        $stmt->execute($params['bindParam']);

        return $stmt;
    
        echo "Connected successfully";
    
    } catch(PDOException $e) {
    
        echo "Connection failed: " . $e->getMessage();
      
    }

	return $params;

}

function filterParams($dirty)
{

	$map = array(
		// Windows codepage 1252
		"\xC2\x82" => "'", // U+0082â‡’U+201A single low-9 quotation mark
		"\xC2\x84" => '"', // U+0084â‡’U+201E double low-9 quotation mark
		"\xC2\x8B" => "'", // U+008Bâ‡’U+2039 single left-pointing angle quotation mark
		"\xC2\x91" => "'", // U+0091â‡’U+2018 left single quotation mark
		"\xC2\x92" => "'", // U+0092â‡’U+2019 right single quotation mark
		"\xC2\x93" => '"', // U+0093â‡’U+201C left double quotation mark
		"\xC2\x94" => '"', // U+0094â‡’U+201D right double quotation mark
		"\xC2\x9B" => "'", // U+009Bâ‡’U+203A single right-pointing angle quotation mark

		// Regular Unicode     // U+0022 quotation mark (")
		// U+0027 apostrophe     (')
		"\xC2\xAB"     => '"', // U+00AB left-pointing double angle quotation mark
		"\xC2\xBB"     => '"', // U+00BB right-pointing double angle quotation mark
		"\xE2\x80\x98" => "'", // U+2018 left single quotation mark
		"\xE2\x80\x99" => "'", // U+2019 right single quotation mark
		"\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
		"\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
		"\xE2\x80\x9C" => '"', // U+201C left double quotation mark
		"\xE2\x80\x9D" => '"', // U+201D right double quotation mark
		"\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
		"\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
		"\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
		"\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
	);

	// assign keys and values to variables for better efficiency
	// to check data
	$a = array_keys($map);
	$b = array_values($map);

	foreach ($_REQUEST as $key => $value) {

        $dirty[$key]    = html_entity_decode($value);
        $sanitize[$key] = strip_tags($dirty[$key]);

        // Sanitize input
        $params[$key]   = filter_var(str_replace($a, $b, trim($sanitize[$key])), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

	}

	return $dirty;
	
}

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

		// get user data
		$_SESSION['id']			= $results['id'];
		$_SESSION['first_name']	= $results['first_name'];
		$_SESSION['last_name']	= $results['last_name'];

		header("Location: index.php");

	} else {

		header("Location: login.php");
		
	}

	return $params;

}

function userPunch($params)
{

	$params = filterParams($params);

	foreach ($_REQUEST as $key => $value)
	{

		switch ($key)
		{

			case 'in_day':

				// get user input for inDay
				// insert data to db
			
				$params['dba']['i'] = "INSERT INTO user_punch (user_id, punch_day, time_in, punch_type) VALUES (:user_id, CURDATE(), NOW(), :punch_type)";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_type'	=> 'IN_DAY'
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

			case 'out_break':

				// get user input for inDay
				// insert data to db
			
				$params['dba']['i'] = "INSERT INTO user_punch (user_id, punch_day, time_out, punch_type) VALUES (:user_id, CURDATE(), NOW(), :punch_type)";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id'],
					':punch_type'	=> 'BREAK'
				);
			
				if (dbAccess($params))
				{
			
					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'OUT_BREAK',
						':id'	=> $_SESSION['id']
					);
					
					dbAccess($params);
			
				}

			break;

			case 'in_break':

				// get user input for inDay
				// insert data to db
			
				$params['dba']['u'] = "UPDATE user_punch SET time_in = NOW() WHERE user_id = :user_id AND punch_type = 'BREAK' AND punch_day = CURDATE() AND time_in = '00:00:00'";
				$params['bindParam'] = array(
					':user_id' 		=> $_SESSION['id']
				);
			
				if (dbAccess($params))
				{

					$params['dba']['u'] = "UPDATE user_punch SET punch_type = :punch_type WHERE user_id = :user_id AND punch_type = 'BREAK' AND punch_day = CURDATE()";
					$params['bindParam'] = array(
						':user_id' 		=> $_SESSION['id'],
						':punch_type'	=> 'BREAK'
					);
			
					if (dbAccess($params))
					{

						$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
						$params['bindParam'] = array(
							':emp_status' => 'IN_BREAK',
							':id'	=> $_SESSION['id']
						);
					
						dbAccess($params);

					}
			
				}

			break;

		}

	}

				
	return $params;

}

function punchBreak($params)
{

	$params = filterParams($params);

	foreach ($_REQUEST as $key => $value)
	{

		switch ($key)
		{

			case 'out_break_1':

				$params['dba']['u'] = "UPDATE user_punch SET out_break_1 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE()";
				$params['bindParam'] = array(
					':user_id' => $_SESSION['id']
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

				$params['dba']['u'] = "UPDATE user_punch SET in_break_1 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE()";
				$params['bindParam'] = array(
					':user_id' => $_SESSION['id']
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

			case 'out_break_2':

				$params['dba']['u'] = "UPDATE user_punch SET out_break_2 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE()";
				$params['bindParam'] = array(
					':user_id' => $_SESSION['id']
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

				$params['dba']['u'] = "UPDATE user_punch SET in_break_2 = NOW() WHERE user_id = :user_id AND punch_day = CURDATE()";
				$params['bindParam'] = array(
					':user_id' => $_SESSION['id']
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

			case 'out_lunch':
				// get user input for outBreak
				// update created row of current day of punch
				$params['dba']['u'] = "UPDATE user_punch SET out_lunch = NOW() WHERE user_id = :user_id AND punch_day = CURDATE()";
				$params['bindParam'] = array(
					':user_id' => $_SESSION['id']
				);

				if (dbAccess($params))
				{

					$params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
					$params['bindParam'] = array(
						':emp_status' => 'LUNCH',
						':id'	=> $_SESSION['id']
					);

					dbAccess($params);

				}

			break;

			case 'in_lunch':
				// get user input for outBreak
				// update created row of current day of punch
				$params['dba']['u'] = "UPDATE user_punch SET in_lunch = NOW() WHERE user_id = :user_id AND punch_day = CURDATE()";
				$params['bindParam'] = array(
					':user_id' => $_SESSION['id']
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

			// no other action needed
			default:
			break;

		}

	}

	return $params;

}

?>