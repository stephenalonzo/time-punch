<?php 

function getEmpStatus($params)
{

	$params = filterParams($params);

	$params['dba']['s'] = "SELECT emp_status FROM users WHERE id = :id";
	$params['bindParam'] = array(
		':id'	=> $_SESSION['id']
	);

	$stmt = dbAccess($params);
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function appViews($params)
{

    $params = filterParams($params);
    $results = getEmpStatus($params);

    foreach ($results as $row)
    {

        switch ($row['emp_status'])
        {

            case 'OUT':
                $params['buttonGroup'] = 
                '<button type="submit" name="in_day" class="px-4 py-2 rounded-md bg-green-700 text-white">In Day</button>
                <button type="submit" name="out_break" class="px-4 py-2 rounded-md bg-yellow-500 text-white">Out Break</button>
                <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-blue-700 text-white">Out Lunch</button>';
            break;

            case 'IN':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="out_break" class="px-4 py-2 rounded-md bg-yellow-500 text-white">Out Break</button>
                <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-blue-700 text-white">Out Lunch</button>';
            break;

            case 'OUT_BREAK':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="in_break" class="px-4 py-2 rounded-md bg-green-500 text-white">In Break</button>
                <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-blue-700 text-white">Out Lunch</button>';
            break;
            
            case 'IN_BREAK':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="out_break" class="px-4 py-2 rounded-md bg-yellow-500 text-white">Out Break</button>
                <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-blue-700 text-white">Out Lunch</button>';
            break;

            case 'LUNCH':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="out_break" class="px-4 py-2 rounded-md bg-green-500 text-white">Out Break</button>
                <button type="submit" name="in_lunch" class="px-4 py-2 rounded-md bg-yellow-500 text-white">In Lunch</button>';
            break;

        }

    }

    return $params;

}

?>