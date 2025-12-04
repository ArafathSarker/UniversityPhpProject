<!-- Hero Section -->
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Find your perfect</span>
                        <span class="block text-primary xl:inline">place to call home</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Discover thousands of rooms for rent in the best neighborhoods. Safe, verified, and affordable options tailored to your needs.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="/?page=rooms" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-secondary md:py-4 md:text-lg md:px-10">
                                Browse Rooms
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-primary/10 hover:bg-primary/20 md:py-4 md:text-lg md:px-10">
                                List Your Room
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2850&q=80" alt="Modern apartment interior">
    </div>
</div>

<!-- Search Section -->
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-6 -mt-24 relative z-20">
            <form action="/?page=rooms" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="hidden" name="page" value="rooms">
                <div class="col-span-1 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                        </div>
                        <input type="text" name="location" class="focus:ring-primary focus:border-primary block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 border" placeholder="City, neighborhood...">
                    </div>
                </div>
                <div class="col-span-1 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 border">
                        <option value="">Any Type</option>
                        <option value="private">Private Room</option>
                        <option value="shared">Shared Room</option>
                        <option value="studio">Studio</option>
                        <option value="apartment">Entire Apartment</option>
                    </select>
                </div>
                <div class="col-span-1 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                    <select name="price" class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md py-2 border">
                        <option value="">Any Price</option>
                        <option value="0-500">$0 - $500</option>
                        <option value="500-1000">$500 - $1000</option>
                        <option value="1000+">$1000+</option>
                    </select>
                </div>
                <div class="col-span-1 md:col-span-1 flex items-end">
                    <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary transition duration-150 ease-in-out flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Featured Rooms -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Featured Listings</h2>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Check out our top-rated rooms available for rent right now.
            </p>
        </div>

        <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($featuredRooms as $room): ?>
            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-shadow duration-300">
                <div class="flex-shrink-0 relative">
                    <img class="h-48 w-full object-cover" src="<?php echo $room['image']; ?>" alt="<?php echo $room['title']; ?>">
                    <div class="absolute top-4 right-4 bg-white px-2 py-1 rounded-md font-bold text-primary shadow-sm">
                        ৳<?php echo $room['price']; ?>/<?php echo $room['rent_type'] == 'Monthly' ? 'mo' : 'day'; ?>
                    </div>
                </div>
                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-primary">
                            <a href="#" class="hover:underline">Featured</a>
                        </p>
                        <a href="/?page=room&id=<?php echo $room['id']; ?>" class="block mt-2">
                            <p class="text-xl font-semibold text-gray-900"><?php echo $room['title']; ?></p>
                            <p class="mt-3 text-base text-gray-500 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i> <?php echo $room['location']; ?>
                            </p>
                        </a>
                    </div>
                    <div class="mt-6 flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                        <div class="flex items-center">
                            <i class="fas fa-bed mr-2"></i> <?php echo $room['beds']; ?> Bed
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-bath mr-2"></i> <?php echo $room['baths']; ?> Bath
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-ruler-combined mr-2"></i> <?php echo $room['sqft']; ?> sqft
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-12 text-center">
            <a href="/?page=rooms" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-primary/10 hover:bg-primary/20">
                View All Rooms <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Why Choose Us</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                A better way to find housing
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                We simplify the rental process with verified listings, secure payments, and 24/7 support.
            </p>
        </div>

        <div class="mt-10">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Verified Listings</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Every room is personally visited and verified by our team to ensure quality and safety.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Secure Booking</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Book with confidence using our secure payment platform. Your money is safe with us.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <i class="fas fa-headset text-xl"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">24/7 Support</p>
                    </dt>
                    <dd class="mt-2 ml-16 text-base text-gray-500">
                        Our dedicated support team is available around the clock to assist you with any issues.
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
