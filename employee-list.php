<?php

require_once('header.php');
require_once('prevent.php');
require_once('controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List | Oras</title>
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto lg:w-1/3">
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <form action="" method="post" class="m-0">
                    <table class="min-w-full divide-y-2 divide-gray-200 bg-white">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-start px-4 py-2 font-medium text-gray-900 w-full">
                                    Name
                                </th>
                                <th class="px-4 py-2">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <?php viewAllEmployee($params); ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </section>
</body>

</html>