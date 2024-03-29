<?php 

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set('America/Los_Angeles');

require_once ('php/db_access.php');
require_once ('php/filter_params.php');
require_once ('php/user_session.php');
require_once ('php/user_punch_input.php');
require_once ('php/total_hours_punch.php');
require_once ('php/time_off_request_input.php');
require_once ('php/get_employee_status.php');
require_once ('php/update_employee_status.php');
require_once ('php/get_pay_period_list.php');
require_once ('php/generate_pay_period.php');
require_once ('php/get_hours_worked_today.php');
require_once ('php/get_hours_worked_weekly.php');
require_once ('php/set_pay_period.php');
require_once ('php/user_punch_data.php');
require_once ('php/get_user_data.php');
require_once ('php/get_time_off_request.php');
require_once ('php/get_accrual.php');
require_once ('php/time_off_request_process.php');
require_once ('php/get_employee_list.php');
require_once ('php/role_authentication.php');
require_once ('php/app_views.php');

foreach ($_REQUEST as $key => $value)
{

    switch($key)
    {

        case 'login':
            userLogin($params);
        break;

        case 'in_day':
            userPunch($params);
        break;

        case 'out_break_1':
            userPunch($params);
        break;

        case 'in_break_1':
            userPunch($params);
        break;

        case 'out_lunch':
            userPunch($params);
        break;

        case 'in_lunch':
            userPunch($params);
        break;

        case 'out_break_2':
            userPunch($params);
        break;

        case 'in_break_2':
            userPunch($params);
        break;

        case 'out_day':
            userPunch($params);
            totalHoursPunch($params);
        break;

        case 'timeoff_request':
            timeOffRequest($params);
        break;

        case 'timeoff_approve':
            timeOffRequestProcess($params);
        break;

        case 'timeoff_deny':
            timeOffRequestProcess($params);
        break;

        case 'logout':
            userLogout();
        break;

        default:
            setPayPeriod($params);
            generatePayPeriod($params);
            deleteTimeOffRequest($params);
        break;

    }

}

?>