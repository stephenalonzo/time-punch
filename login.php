<?php

require_once('header.php');
require_once('controller.php');

if (isset($_SESSION['id']) && $_SESSION['id'])
{

    header("Location: index.php");

}

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
        <div class="container mx-auto relative">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-full">
                <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-lg text-center">
                        <h1 class="text-2xl font-bold sm:text-3xl">Employee Login</h1>
                    </div>

                    <form action="" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
                        <div>
                            <label for="email" class="sr-only">Email</label>

                            <div class="relative">
                                <input type="text" name="username" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Employee ID" />
                            </div>
                        </div>

                        <div>
                            <label for="password" class="sr-only">Password</label>

                            <div class="relative">
                                <input type="password" name="password" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm" placeholder="Password" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" name="login" class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white">
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>