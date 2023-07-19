<?php 

function roleAuthentication($params)
{

    $params['dba']['s'] = "SELECT * FROM users WHERE id = :id";
    $params['bindParam'] = array(
        ':id'   => $_SESSION['id']
    );

    $stmt = dbAccess($params);
    $params['results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($params['results'] as $row)
    {

        if ($row['user_role'] != 'ADMIN')
        {

            header("Location: index.php");

        }

    }

}

?>