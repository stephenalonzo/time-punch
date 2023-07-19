<?php

require_once('header.php');
require_once('prevent.php');
require_once('controller.php');

roleAuthentication($params);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Time-Off Requests | Oras</title>
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto lg:w-2/3">
            <div class="rounded-lg border border-gray-200 overflow-x-auto">
                <form action="" method="post" class="m-0">
                    <table class="w-full divide-y-2 divide-gray-200 bg-white">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Employee
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Time-Off Start
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Time-Off End
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Status
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            <?php

                            $params = viewTimeOffRequest($params);

                            ?>
                        </tbody>
                    </table>
            </div>
            </form>
        </div>
    </section>
</body>

</html>