<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- Sidebar Filters -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Filters</h2>
                        <a href="/?page=rooms" class="text-sm text-primary hover:underline">Reset</a>
                    </div>
                    
                    <form action="/?page=rooms" method="GET">
                        <input type="hidden" name="page" value="rooms">
                        
                        <!-- Location -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2" placeholder="City or Zip">
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                            <div class="flex items-center space-x-2">
                                <input type="number" name="min_price" placeholder="Min" class="w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                                <span class="text-gray-500">-</span>
                                <input type="number" name="max_price" placeholder="Max" class="w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                            </div>
                        </div>

                        <!-- Room Type -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Room Type</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="type-private" name="type[]" value="private" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="type-private" class="ml-2 block text-sm text-gray-700">Private Room</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="type-shared" name="type[]" value="shared" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="type-shared" class="ml-2 block text-sm text-gray-700">Shared Room</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="type-studio" name="type[]" value="studio" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="type-studio" class="ml-2 block text-sm text-gray-700">Studio</label>
                                </div>
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input id="amenity-wifi" name="amenities[]" value="wifi" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="amenity-wifi" class="ml-2 block text-sm text-gray-700">Wifi</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="amenity-ac" name="amenities[]" value="ac" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="amenity-ac" class="ml-2 block text-sm text-gray-700">Air Conditioning</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="amenity-parking" name="amenities[]" value="parking" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="amenity-parking" class="ml-2 block text-sm text-gray-700">Parking</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary transition duration-150 ease-in-out">
                            Apply Filters
                        </button>
                    </form>
                </div>
            </div>

            <!-- Room Listings -->
            <div class="w-full md:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Available Rooms</h1>
                    <div class="flex items-center">
                        <span class="mr-2 text-sm text-gray-500">Sort by:</span>
                        <select class="border-gray-300 rounded-md text-sm focus:ring-primary focus:border-primary border p-1">
                            <option>Recommended</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                    <?php foreach ($rooms as $room): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        <div class="relative h-48">
                            <img class="w-full h-full object-cover" src="<?php echo $room['image']; ?>" alt="<?php echo $room['title']; ?>">
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-sm font-bold text-gray-900">
                                ৳<?php echo $room['price']; ?>/hr
                            </div>
                            <div class="absolute bottom-3 left-3 bg-black/50 backdrop-blur-sm px-2 py-1 rounded text-xs font-medium text-white">
                                <?php echo $room['type']; ?>
                            </div>
                        </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1 truncate">
                                    <a href="/?page=room&id=<?php echo $room['id']; ?>" class="hover:text-primary transition"><?php echo $room['title']; ?></a>
                                </h3>
                                <p class="text-sm text-gray-500 mb-3 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1.5 text-gray-400"></i> <?php echo $room['location']; ?>
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                    <span class="flex items-center"><i class="fas fa-bed mr-1"></i> <?php echo $room['beds']; ?> Bed</span>
                                    <span class="flex items-center"><i class="fas fa-bath mr-1"></i> <?php echo $room['baths']; ?> Bath</span>
                                    <span class="flex items-center"><i class="fas fa-ruler-combined mr-1"></i> <?php echo $room['sqft']; ?> sqft</span>
                                </div>
                            </div>
                            <a href="/?page=room&id=<?php echo $room['id']; ?>" class="block w-full text-center bg-gray-50 text-primary font-medium py-2 rounded hover:bg-primary hover:text-white transition duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-primary border-primary text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            3
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
