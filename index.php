<?php 

require_once ('header.php');
require_once ('authenticate.php');
require_once ('controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oras</title>
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto space-y-4">
            <div class="flex flex-col items-center justify-center space-y-1">
                <div id="time" class="font-semibold text-3xl"></div>
                <div id="date"></div>
            </div>
            <div class="flex items-center justify-center space-x-4">
                <form action="" method="post">
                    <!-- <button type="submit" name="in_day" class="px-4 py-2 rounded-md bg-green-700 text-white">In Day</button>
                    <button type="submit" name="out_break" class="px-4 py-2 rounded-md bg-yellow-500 text-white">Out Break</button>
                    <button type="submit" name="out_lunch" class="px-4 py-2 rounded-md bg-red-700 text-white">Out Lunch</button> -->
                    <?php 
                    
                    $params = appViews($params);

                    echo $params['buttonGroup'];
                    
                    ?>
                </form>
            </div>
        </div>
    </section>
    <script src="./src/startTime.js"></script>
</body>
</html>