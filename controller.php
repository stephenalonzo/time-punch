<?php 

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set('America/Los_Angeles');

require_once ('php/app.php');
require_once ('php/app-views.php');

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

        case 'out_break':
            userPunch($params);
        break;

        case 'in_break':
            userPunch($params);
        break;

        case 'out_lunch':
            userPunch($params);
        break;

        case 'in_lunch':
            userPunch($params);
        break;

        case 'out_day':
            userPunch($params);
        break;

        case 'logout':
            userLogout();
        break;

    }

}

?>