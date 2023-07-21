<?php 

function getTimeOffRequest($params)
{

    $params['dba']['s'] = "SELECT * FROM time_off_request";
    
    $stmt = dbAccess($params);
    $params['results']  = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $params;

}

?>