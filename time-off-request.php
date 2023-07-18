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
    <title>Time Off Request | Oras</title>
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
<section class="px-4 py-6">
        <div class="container mx-auto relative">
            <div class="">
                <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-lg text-center">
                        <h1 class="text-2xl font-bold sm:text-3xl">Time Off Request</h1>
                    </div>

                    <form action="" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
                        <input type="text" name="username" class="w-full rounded-md border border-gray-200 p-4" placeholder="Employee ID" />

                        <div class="flex flex-row items-center space-x-4">
                            <input type="date" name="timeoff_start" class="w-full rounded-md border border-gray-200 p-4" />
                            <input type="date" name="timeoff_end" class="w-full rounded-md border border-gray-200 p-4" />
                        </div>
                        
                        <div class="grid grid-cols-5 gap-4 items-center">
                            <?php 
                            
                            $params = viewAccrual($params);
                            
                            ?>

                            <label for="" class="col-span-2"><span class="font-medium">Available Accrual</span>: <?php echo $params['accrual']; ?></label>

                            <input type="number" name="timeoff_hours" class="col-span-3 w-full rounded-md border border-gray-200 p-4" max="<?php echo $params['accrual']; ?>"/>
                        </div>

                        <textarea name="timeoff_reason" id="" class="p-4 rounded-md w-full h-52 border border-gray-200 resize-none" placeholder="Reason for Leave"></textarea>

                        <button type="submit" name="timeoff_request" class="inline-block rounded-md bg-blue-500 px-5 py-3 font-medium text-white">
                                Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>