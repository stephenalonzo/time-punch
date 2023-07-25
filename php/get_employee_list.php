<?php 

function getAllEmployee($params)
{

    $params['dba']['s'] = "SELECT * FROM users";

    $stmt = dbAccess($params);
    $params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $params;

}

?>