<?php 

function getUserData($params)
{

    $params = filterParams($params);

    $params['dba']['s'] = "SELECT * FROM users WHERE id = :id";
    $params['bindParam'] = array(
        ':id'   => $_SESSION['id']
    );
    
    $stmt = dbAccess($params);
    $params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $params;
    
}

?>