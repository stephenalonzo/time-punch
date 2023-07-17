<?php 

function dbAccess($params)
{

    try {
    
        $pdo = new PDO("mysql:host=localhost;dbname=timepunch", 'root', '');

        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($params['dba'] as $key => $value)
        {

            $stmt = $pdo->prepare($params['dba'][$key]);

        }

        $stmt->execute($params['bindParam']);

        return $stmt;
    
        echo "Connected successfully";
    
    } catch(PDOException $e) {
    
        echo "Connection failed: " . $e->getMessage();
      
    }

	return $params;

}

?>