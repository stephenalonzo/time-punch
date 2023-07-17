<?php 

function calculateWeeklyHours($params)
{

	$params = filterParams($params);
	$params = getHoursWorkedWeekly($params);

	$params['total'] = 0;

	foreach ($params['results'] as $row)
	{

		if (!empty($row['total_hours']))
		{

			$params['total'] += $row['total_hours'].'<br>';
			
		}

	}

	echo $params['total'];

	return $params;

}


?>