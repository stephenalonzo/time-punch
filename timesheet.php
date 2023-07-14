<?php

require_once('header.php');
require_once('authenticate.php');
require_once('controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet | Oras</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto w-2/3">
            <div class="rounded-lg border border-gray-200 overflow-hidden">
                <table class="w-full divide-y-2 divide-gray-200 bg-white text-sm">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Date
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                In Day
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Out Break
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                In Break
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Out Lunch
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                In Lunch
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Out Break
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                In Break
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Out Day
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <?php 
                        
                        $params = readOnlyTimesheet($params);

                        echo $params['timesheetRow'];
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>