<?php 

function getAccrual($params, $user_id)
{

    $params = filterParams($params);

    // Get user accrual hours
    
    $params['dba']['s'] = "SELECT * FROM accrual_bank WHERE user_id = :user_id";
    $params['bindParam'] = array(
        ':user_id'  => $user_id
    );

    $stmt = dbAccess($params);
    $params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $params;

}

?>