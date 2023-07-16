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
        <div class="container mx-auto w-2/3 space-y-4">
            <form action="" method="post" class="w-1/3 flex flex-row items-end space-x-4">
                <div>
                    <label for="HeadlineAct" class="block text-sm font-medium text-gray-900">
                        Select Pay-Period:
                    </label>
                    <select name="pay_period" id="HeadlineAct" class="mt-1.5 p-2 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                        <?php

                        $params = viewPayPeriods($params);

                        echo $params['payPeriodsList'];

                        ?>
                    </select>
                </div>
                <button type="submit" name="pp_view" class="rounded-lg bg-blue-600 px-5 py-2 font-medium text-white">View</button>
            </form>
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
                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                Total Hours
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
            <div class="flex flex-row items-center justify-end">
                <span class="font-medium">Total Hours worked: <?php $params = viewTotalHours($params); echo $params['totalHours']; ?></span>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>