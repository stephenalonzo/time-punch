<?php 

function buttonGroup($params)
{

    $params = filterParams($params);
    $params = getEmpStatus($params);

    foreach ($params['results'] as $row)
    {

        switch ($row['emp_status'])
        {

            case 'OUT':
                $params['buttonGroup'] = 
                '<button type="submit" name="in_day" class="px-4 py-2 rounded-md bg-green-500 text-white font-semibold">In Day</button>';
            break;

            case 'IN':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>
                <button type="submit" name="out_break_1" class="px-4 py-2 rounded-md bg-yellow-500 text-white font-semibold">Out Break</button>';
            break;

            case 'OUT_BREAK_1':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>
                <button type="submit" name="in_break_1" class="px-4 py-2 rounded-md bg-green-500 text-white font-semibold">In Break</button>';
            break;
            
            case 'IN_BREAK_1':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>
                <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-blue-700 text-white font-semibold">Out Lunch</button>';
            break;

            case 'OUT_LUNCH':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>
                <button type="submit" name="in_lunch" class="px-4 py-2 rounded-md bg-green-500 text-white font-semibold">In Lunch</button>';
            break;

            case 'IN_LUNCH':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>
                <button type="submit" name="out_break_2" class="px-4 py-2 rounded-md bg-yellow-500 text-white font-semibold">Out Break</button>';
            break;

            case 'OUT_BREAK_2':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>
                <button type="submit" name="in_break_2" class="px-4 py-2 rounded-md bg-green-500 text-white font-semibold">In Break</button>';
            break;

            case 'IN_BREAK_2':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white font-semibold">Out Day</button>';
            break;

            default:
                $params['buttonGroup'] = 
                    '<button type="submit" name="in_day" class="px-4 py-2 rounded-md bg-green-500 text-white font-semibold">In Day</button>';
            break;

        }

        echo $params['buttonGroup'];

    }

    // return $params;

}

function readOnlyTimesheet($params)
{

    $params = filterParams($params);
    $params = userPunchData($params);

    foreach ($params['results'] as $row)
    {

        $params['timesheetRow'] =
        '<tr>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">'.date('D m/d/Y', strtotime($row['punch_day'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['in_day'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['out_break_1'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['in_break_1'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['out_lunch'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['in_lunch'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['out_break_2'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['in_break_2'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('H:i:s A', strtotime($row['out_day'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.$row['total_hours'].'</td>
        </tr>';

        echo $params['timesheetRow'];

    }

}

function viewPayPeriods($params)
{

    $params = filterParams($params);
    $params['results'] = getPayPeriods($params);

    foreach ($params['results'] as $row)
    {

        switch ($params['pay_period'])
        {

            case $row['id']:
                $params['payPeriodsList'] =
                '<option value="'.$row['id'].'" selected>'.date('m/d/Y', strtotime($row['pp_start'])).''.' - '.''.date('m/d/Y', strtotime($row['pp_end'])).'</option>';
            break;

            default:
                $params['payPeriodsList'] =
                '<option value="'.$row['id'].'">'.date('m/d/Y', strtotime($row['pp_start'])).''.' - '.''.date('m/d/Y', strtotime($row['pp_end'])).'</option>';
            break;

        }

        echo $params['payPeriodsList'];

    }

}

function viewTotalHours($params)
{

	$params = filterParams($params);
	$params = getHoursWorkedWeekly($params);

	$params['total'] = 0;

	foreach ($params['results'] as $row)
	{

		if (!empty($row['total_hours']))
		{

			$params['total'] += $row['total_hours'];
			$params['total_hours'] = $params['total'];
			
		}

		
	}
	
	echo $params['total_hours'];

}

function viewAccrual($params)
{

    $params = filterParams($params);
    
    $user_id = $_SESSION['id'];
    $params = getAccrual($params, $user_id);

    foreach ($params['results'] as $row)
    {

        $params['accrual'] = $row['accrual'];

    }

    return $params;

}

function roleView($params)
{

    $params = filterParams($params);
    $params = getUserData($params);

    foreach ($params['results'] as $row)
    {

        if ($row['user_role'] == 'ADMIN')
        {

            $params['appHeader'] =
            '<header class="shadow-sm">
                <div class="mx-auto h-16 max-w-screen-xl flex items-center justify-between px-4">
                    <nav aria-label="Global" class="items-center gap-8 font-medium flex w-0 flex-1">
                        <a class="text-gray-900" href="./">Home</a>
                        <a class="text-gray-900" href="./manage-time-off-request.php">Manage Time-Off Requests</a>
                    </nav>
        
                    <div class="flex items-center space-x-4">
                        <span class="">Welcome back, '.$_SESSION['first_name'].'!</span>
                        <form action="" method="post" class="m-0">
                            <button type="submit" name="logout" class="rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>';

        } else {

            $params['appHeader'] =
            '<header class="shadow-sm">
                <div class="mx-auto h-16 max-w-screen-xl flex items-center justify-between px-4">
                    <nav aria-label="Global" class="items-center gap-8 font-medium flex w-0 flex-1">
                        <a class="text-gray-900" href="./">Home</a>
                        <a class="text-gray-900" href="./time-off-request.php">Request Time-Off</a>
                    </nav>
        
                    <div class="flex items-center space-x-4">
                        <span class="">Welcome back, '.$_SESSION['first_name'].'!</span>
                        <form action="" method="post" class="m-0">
                            <button type="submit" name="logout" class="rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>';
            
        }

    }

    echo $params['appHeader'];

}

function viewTimeOffRequest($params)
{

    $params = filterParams($params);
    $params = getTimeOffRequest($params);

    foreach ($params['results'] as $row)
    {

        $params['timeOffRow'] =
        '<tr>
            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
                <span>'.$row['emp_name'].'</span>
                <input type="text" name="user_id" class="w-0 opacity-0 pointer-events-none border-none" value="'.$row['user_id'].'" />
            </td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('D m/d/Y', strtotime($row['timeoff_start'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.date('D m/d/Y', strtotime($row['timeoff_end'])).'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">'.$row['timeoff_status'].'</td>
            <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">
                <span class="flex flex-row items-center justify-center space-x-4">
                    <button type="submit" name="timeoff_approve" class="rounded-lg bg-green-500 px-5 py-2 font-semibold text-white">
                        Approve
                    </button>
                    <button type="submit" name="timeoff_deny" class="rounded-lg bg-red-500 px-5 py-2 font-semibold text-white">
                        Deny
                    </button>
                </span>
            </td> 
        </tr>';

        echo $params['timeOffRow'];

    }

}

?>