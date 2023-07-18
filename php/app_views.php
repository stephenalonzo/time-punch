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
                '<button type="submit" name="in_day" class="px-4 py-2 rounded-md bg-green-500 text-white">In Day</button>';
            break;

            case 'IN':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="out_break_1" class="px-4 py-2 rounded-md bg-yellow-500 text-white">Out Break</button>';
            break;

            case 'OUT_BREAK_1':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="in_break_1" class="px-4 py-2 rounded-md bg-green-500 text-white">In Break</button>';
            break;
            
            case 'IN_BREAK_1':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-blue-700 text-white">Out Lunch</button>';
            break;

            case 'OUT_LUNCH':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="in_lunch" class="px-4 py-2 rounded-md bg-green-500 text-white">In Lunch</button>';
            break;

            case 'IN_LUNCH':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="out_break_2" class="px-4 py-2 rounded-md bg-yellow-500 text-white">Out Break</button>';
            break;

            case 'OUT_BREAK_2':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>
                <button type="submit" name="in_break_2" class="px-4 py-2 rounded-md bg-green-500 text-white">In Break</button>';
            break;

            case 'IN_BREAK_2':
                $params['buttonGroup'] = 
                '<button type="submit" name="out_day" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Day</button>';
            break;

            default:
                $params['buttonGroup'] = 
                    '<button type="submit" name="in_day" class="px-4 py-2 rounded-md bg-green-500 text-white">In Day</button>';
            break;

        }

        echo $params['buttonGroup'];

    }

    // return $params;

}

function readOnlyTimesheet($params)
{

    $params = filterParams($params);
    $params['results'] = userPunchData($params);

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

    // return $params;

}

function viewPayPeriods($params)
{

    $params = filterParams($params);
    $params['results'] = getPayPeriods($params);

    foreach ($params['results'] as $row)
    {

        $params['payPeriodsList'] =
        '<option value="'.$row['id'].'">'.date('m/d/Y', strtotime($row['pp_start'])).''.' - '.''.date('m/d/Y', strtotime($row['pp_end'])).'</option>';

        echo $params['payPeriodsList'];

    }

    // return $params;

}

function viewTotalHours($params)
{

    $params = filterParams($params);
    $params = calculateWeeklyHours($params);

    $params['totalHours'] = $params['totalCalculated'];

    return $params;

}

?>