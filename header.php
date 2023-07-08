<?php 

include_once('php/session.php');
require_once('controller.php');

if (isset($_SESSION['id']) && $_SESSION['id'])
{
    
?>

<header class="shadow-sm">
    <div class="mx-auto flex h-16 max-w-screen-xl items-center justify-between px-4">
        <div class="flex w-0 flex-1 lg:hidden">
            <button class="rounded-full bg-gray-100 p-2 text-gray-600" type="button">
                <span class="sr-only">Account</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </button>
        </div>

        <div class="flex items-center gap-4">
            <a href="#">
                <span class="sr-only">Logo</span>
                <span class="h-10 w-20 rounded-lg bg-gray-200"></span>
            </a>
        </div>

        <div class="flex w-0 flex-1 justify-end lg:hidden">
            <button class="rounded-full bg-gray-100 p-2 text-gray-500" type="button">
                <span class="sr-only">Menu</span>
                <svg class="h-5 w-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <nav aria-label="Global" class="hidden items-center justify-center gap-8 font-medium lg:flex lg:w-0 lg:flex-1">
            <a class="text-gray-900" href="">Home</a>
            <a class="text-gray-900" href="">Timesheet</a>
            <a class="text-gray-900" href="">Time-Off Request</a>
        </nav>

        <div class="hidden items-center gap-4 lg:flex">
            <span>Welcome back, <?php echo $_SESSION['first_name']; ?>!</span>

            <a href="./logout.php" class="rounded-lg bg-blue-600 px-5 py-2 font-medium text-white">
                Logout
            </a>
        </div>
    </div>

    <div class="border-t border-gray-100 lg:hidden">
        <ul class="flex items-center justify-center overflow-x-auto p-4 font-medium">
            <li><a class="shrink-0 px-4 text-gray-900" href="">About</a></li>
            <li><a class="shrink-0 px-4 text-gray-900" href="">Blog</a></li>
            <li><a class="shrink-0 px-4 text-gray-900" href="">Projects</a></li>
            <li><a class="shrink-0 px-4 text-gray-900" href="">Contact</a></li>
        </ul>
    </div>
</header>

<?php } ?>