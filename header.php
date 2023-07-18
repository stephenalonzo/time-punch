<?php 

include_once('php/session.php');
require_once('controller.php');

if (isset($_SESSION['id']) && $_SESSION['id'])
{
    
?>

<header class="shadow-sm">
    <div class="mx-auto h-16 max-w-screen-xl flex items-center justify-between px-4">
        <nav aria-label="Global" class="items-center gap-8 font-medium flex w-0 flex-1">
            <a class="text-gray-900" href="./">Home</a>
            <a class="text-gray-900" href="./time-off-request.php">Time-Off Request</a>
        </nav>

        <div class="flex items-center space-x-4">
            <span class="">Welcome back, <?php echo $_SESSION['first_name']; ?>!</span>
            <form action="" method="post" class="m-0">
                <button type="submit" name="logout" class="rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<?php } ?>