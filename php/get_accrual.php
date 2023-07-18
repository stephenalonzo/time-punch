<?php 

function getAccrual($params)
{

    $params = filterParams($params);

    // Get user accrual hours
    
    $params['dba']['s'] = "SELECT * FROM accrual_bank WHERE user_id = :user_id";
    $params['bindParam'] = array(
        ':user_id'  => $_SESSION['id']
    );

    $stmt = dbAccess($params);
    $params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $params;

}

?>