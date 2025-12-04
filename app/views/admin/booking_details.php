<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#1e40af',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div class="flex flex-col h-0 flex-1 bg-gray-800">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <span class="text-white text-xl font-bold"><i class="fas fa-shield-alt mr-2"></i>Admin Panel</span>
                    </div>
                    <nav class="mt-5 flex-1 px-2 space-y-1">
                        <a href="/?page=admin_dashboard" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                            Dashboard
                        </a>
                        <a href="/?page=admin_rooms" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-home mr-3 text-gray-400 group-hover:text-gray-300"></i>
                            Rooms
                        </a>
                        <a href="/?page=admin_users" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-users mr-3 text-gray-400 group-hover:text-gray-300"></i>
                            Users
                        </a>
                        <a href="/?page=admin_bookings" class="bg-gray-900 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-shopping-cart mr-3 text-gray-300"></i>
                            Bookings
                        </a>
                    </nav>
                </div>
                <div class="flex-shrink-0 flex bg-gray-700 p-4">
                    <a href="/?page=admin_logout" class="flex-shrink-0 w-full group block">
                        <div class="flex items-center">
                            <div>
                                <i class="fas fa-sign-out-alt inline-block h-9 w-9 rounded-full text-white pt-2 pl-2 bg-gray-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">Logout</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <div class="flex items-center mb-4">
                        <a href="/?page=admin_bookings" class="text-gray-500 hover:text-gray-700 mr-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-2xl font-semibold text-gray-900">Booking Details</h1>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mt-8">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Booking #<?php echo $booking['id']; ?></h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Created on <?php echo date('F j, Y, g:i a', strtotime($booking['created_at'])); ?></p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo $booking['status'] === 'Confirmed' ? 'bg-green-100 text-green-800' : ($booking['status'] === 'Cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                <?php echo $booking['status']; ?>
                            </span>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">User Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo $booking['first_name'] . ' ' . $booking['last_name']; ?></dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">User Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo $booking['email']; ?></dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Room</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo $booking['room_title']; ?></dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Check-in</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo date('F j, Y', strtotime($booking['check_in'])); ?></dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Check-out</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><?php echo date('F j, Y', strtotime($booking['check_out'])); ?></dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0 sm:col-span-2">৳<?php echo $booking['total_price']; ?></dd>
                                </div>
                            </dl>
                        </div>
                        <?php if($booking['status'] !== 'Cancelled'): ?>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <?php if($booking['status'] === 'Pending'): ?>
                            <a href="/?page=admin_approve_booking&id=<?php echo $booking['id']; ?>" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mr-3">
                                Approve Booking
                            </a>
                            <?php endif; ?>
                            <a href="/?page=admin_cancel_booking&id=<?php echo $booking['id']; ?>" onclick="return confirm('Are you sure you want to cancel this booking?');" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel Booking
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
