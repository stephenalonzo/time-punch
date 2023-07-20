<?php 

require_once ('header.php');
require_once ('prevent.php');
require_once ('controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Oras</title>
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto">
            <div class="flex flex-col items-center justify-center space-y-1">
                <div id="time" class="font-semibold text-4xl"></div>
                <div id="date"></div>
            </div>
        </div>
    </section>
    <section class="px-4 py-6">
        <div class="container mx-auto space-y-4 lg:w-2/3">
            <div class="flex flex-col items-center justify-center lg:flex-row lg:justify-between">
                <form action="" method="post" class="w-full flex flex-row items-end justify-center space-x-4 lg:justify-start">
                    <div>
                        <label for="HeadlineAct" class="block font-medium text-gray-900">
                            Select Pay-Period:
                        </label>
                        <select name="pay_period" id="HeadlineAct" class="mt-1.5 p-2 w-full rounded-lg border border-gray-300 text-gray-700">
                            <?php $params = viewPayPeriods($params); ?>
                        </select>
                    </div>
                    <button type="submit" name="pp_view" class="rounded-lg bg-black/90 px-5 py-2 font-semibold text-white">View</button>
                </form>
                <div class="flex items-center justify-center space-x-4 w-full lg:justify-end">
                    <form action="" method="post" class="m-0">
                        <?php $params = buttonGroup($params); ?>
                    </form>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 overflow-x-auto">
                <table class="w-full divide-y-2 divide-gray-200 bg-white">
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

                        ?>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-row items-center justify-end">
                <span class="font-medium">Total Hours: <?php $params = viewTotalHours($params); ?></span>
            </div>
        </div>
    </section>
    <script src="./src/startTime.js"></script>
</body>
</html>