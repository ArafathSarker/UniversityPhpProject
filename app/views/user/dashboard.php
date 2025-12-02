<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="md:w-1/4">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="p-6 bg-primary text-white text-center">
                        <div class="h-24 w-24 rounded-full bg-white mx-auto flex items-center justify-center text-primary text-4xl mb-4">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2 class="text-xl font-bold"><?php echo $user['name']; ?></h2>
                        <p class="text-blue-100"><?php echo $user['email']; ?></p>
                    </div>
                    <nav class="p-4 space-y-2">
                        <a href="/?page=user_dashboard" class="block px-4 py-2 rounded-md bg-primary text-white font-medium shadow-md">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="fas fa-calendar-check mr-3"></i> My Bookings
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="fas fa-heart mr-3"></i> Favorites
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="fas fa-cog mr-3"></i> Settings
                        </a>
                        <hr class="my-2">
                        <a href="/?page=home" class="block px-4 py-2 rounded-md text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:w-3/4">
                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white shadow rounded-lg p-6 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-primary mr-4">
                            <i class="fas fa-calendar-check text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Bookings</p>
                            <p class="text-2xl font-bold text-gray-900">12</p>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-6 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Hours Rented</p>
                            <p class="text-2xl font-bold text-gray-900">48</p>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-6 flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <i class="fas fa-wallet text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Spent</p>
                            <p class="text-2xl font-bold text-gray-900">৳24,000</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Recent Bookings</h3>
                        <a href="#" class="text-sm text-primary hover:text-secondary">View all</a>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($bookings as $booking): ?>
                        <li class="p-6 hover:bg-gray-50 transition">
                            <div class="flex items-center">
                                <img src="<?php echo $booking['image']; ?>" alt="Room" class="h-16 w-16 object-cover rounded-md">
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900"><?php echo $booking['room_title']; ?></h4>
                                            <p class="text-sm text-gray-500"><i class="far fa-calendar mr-1"></i> <?php echo $booking['date']; ?> | <i class="far fa-clock mr-1"></i> <?php echo $booking['time']; ?></p>
                                        </div>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo $booking['status'] === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                            <?php echo $booking['status']; ?>
                                        </span>
                                    </div>
                                    <div class="mt-2 flex justify-between items-center">
                                        <p class="text-sm font-medium text-gray-900">Total: ৳<?php echo $booking['price']; ?></p>
                                        <div class="space-x-2">
                                            <button class="text-sm text-primary hover:text-secondary">View Details</button>
                                            <?php if($booking['status'] === 'Pending'): ?>
                                            <button class="text-sm text-red-600 hover:text-red-800">Cancel</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
