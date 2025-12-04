<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomFinder - Find Your Perfect Stay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#1e40af',
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/?page=home" class="text-2xl font-bold text-primary">
                        <i class="fas fa-home mr-2"></i>RoomFinder
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="/?page=home" class="border-transparent text-gray-500 hover:border-primary hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Home
                    </a>
                    <a href="/?page=rooms" class="border-transparent text-gray-500 hover:border-primary hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Rooms
                    </a>
                    <a href="/?page=about" class="border-transparent text-gray-500 hover:border-primary hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        About Us
                    </a>
                    <a href="/?page=contact" class="border-transparent text-gray-500 hover:border-primary hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Contact
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <a href="/?page=cart" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary mr-2">
                    <span class="sr-only">View cart</span>
                    <i class="fas fa-shopping-cart text-xl"></i>
                </a>
                <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <span class="sr-only">View notifications</span>
                    <i class="far fa-bell text-xl"></i>
                </button>
                <div class="ml-3 relative">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="/?page=user_dashboard" class="text-gray-500 hover:text-primary font-medium text-sm mr-4" title="Dashboard">
                            <i class="fas fa-tachometer-alt text-lg"></i>
                        </a>
                        <span class="text-gray-500 font-medium text-sm mr-4">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="/?page=logout" class="text-gray-500 hover:text-primary font-medium text-sm">Logout</a>
                    <?php else: ?>
                        <a href="/?page=login" class="text-gray-500 hover:text-primary font-medium text-sm mr-4">Log in</a>
                        <a href="/?page=signup" class="bg-primary text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-secondary transition duration-150 ease-in-out">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/?page=home" class="bg-primary/10 border-primary text-primary block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Home</a>
            <a href="/?page=rooms" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Rooms</a>
            <a href="/?page=about" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">About Us</a>
            <a href="/?page=contact" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Contact</a>
        </div>
    </div>
</nav>
<main class="flex-grow">
