<?php 

function updateEmpStatus($params, $status)
{
    
    $params['dba']['u'] = "UPDATE users SET emp_status = :emp_status WHERE id = :id";
    $params['bindParam'] = array(
        ':emp_status' => $status,
        ':id'	=> $_SESSION['id']
    );

    dbAccess($params);

    return $params;

}

?>