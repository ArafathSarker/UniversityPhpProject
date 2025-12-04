<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/?page=home" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                        <a href="/?page=rooms" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2">Rooms</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-1"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2"><?php echo $room['title']; ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Image Gallery -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                    <div class="relative h-96">
                        <img src="<?php echo $room['image']; ?>" alt="Main Room Image" class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-3 gap-2 p-2">
                        <?php foreach ($room['images'] as $img): ?>
                        <div class="h-24 cursor-pointer opacity-70 hover:opacity-100 transition">
                            <img src="<?php echo $img; ?>" alt="Room thumbnail" class="w-full h-full object-cover rounded">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Room Info -->
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php echo $room['title']; ?></h1>
                            <p class="text-gray-500 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-primary"></i> <?php echo $room['location']; ?>
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-primary">৳<?php echo $room['price']; ?></p>
                            <p class="text-gray-500 text-sm">per <?php echo $room['rent_type'] == 'Monthly' ? 'month' : 'day'; ?></p>
                        </div>
                    </div>

                    <div class="flex border-b border-gray-200 pb-6 mb-6">
                        <div class="flex-1 text-center border-r border-gray-200">
                            <span class="block text-2xl font-bold text-gray-800"><?php echo $room['beds']; ?></span>
                            <span class="text-gray-500 text-sm">Bedrooms</span>
                        </div>
                        <div class="flex-1 text-center border-r border-gray-200">
                            <span class="block text-2xl font-bold text-gray-800"><?php echo $room['baths']; ?></span>
                            <span class="text-gray-500 text-sm">Bathrooms</span>
                        </div>
                        <div class="flex-1 text-center">
                            <span class="block text-2xl font-bold text-gray-800"><?php echo $room['sqft']; ?></span>
                            <span class="text-gray-500 text-sm">Sq Ft</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Description</h2>
                        <p class="text-gray-600 leading-relaxed">
                            <?php echo $room['description']; ?>
                        </p>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Amenities</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <?php foreach ($room['amenities'] as $amenity): ?>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i> <?php echo $amenity; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Host Info -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Hosted by</h3>
                    <div class="flex items-center mb-4">
                        <img src="<?php echo $room['host']['image']; ?>" alt="Host" class="h-12 w-12 rounded-full mr-4">
                        <div>
                            <p class="font-medium text-gray-900"><?php echo $room['host']['name']; ?></p>
                            <p class="text-sm text-gray-500">Joined <?php echo $room['host']['joined']; ?></p>
                        </div>
                    </div>
                    <button class="w-full border border-primary text-primary font-medium py-2 rounded hover:bg-primary/5 transition">
                        Contact Host
                    </button>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Book this room</h3>
                    <form action="/?page=book_room" method="POST">
                        <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                        <input type="hidden" name="rent_type" value="<?php echo $room['rent_type']; ?>">
                        
                        <?php if ($room['rent_type'] == 'Daily'): ?>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                            <input type="date" name="check_in_date" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                            <input type="date" name="check_out_date" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                        </div>
                        <?php else: ?>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="check_in_date" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Duration (Months)</label>
                            <input type="number" name="duration" min="1" value="1" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                        </div>
                        <?php endif; ?>

                        <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-md hover:bg-secondary transition shadow-md">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
