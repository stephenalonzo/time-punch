<?php 

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set('America/Los_Angeles');

require_once ('php/app.php');

foreach ($_REQUEST as $key => $value)
{

    switch($key)
    {

        case 'login':
            userLogin($params);
        break;

    }

}

?>