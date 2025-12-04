<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room - Admin</title>
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
                        <a href="/?page=admin_rooms" class="bg-gray-900 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-home mr-3 text-gray-300"></i>
                            Rooms
                        </a>
                        <a href="/?page=admin_users" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-users mr-3 text-gray-400 group-hover:text-gray-300"></i>
                            Users
                        </a>
                        <a href="/?page=admin_bookings" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-shopping-cart mr-3 text-gray-400 group-hover:text-gray-300"></i>
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
                    <h1 class="text-2xl font-semibold text-gray-900">Edit Room</h1>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mt-8">
                    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                        <form action="/?page=admin_edit_room&id=<?php echo $room['id']; ?>" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Room Title</label>
                                    <div class="mt-1">
                                        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($room['title']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Room Type</label>
                                    <div class="mt-1">
                                        <select id="type" name="type" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                            <option <?php echo $room['type'] == 'Studio' ? 'selected' : ''; ?>>Studio</option>
                                            <option <?php echo $room['type'] == 'Apartment' ? 'selected' : ''; ?>>Apartment</option>
                                            <option <?php echo $room['type'] == 'Penthouse' ? 'selected' : ''; ?>>Penthouse</option>
                                            <option <?php echo $room['type'] == 'Shared Room' ? 'selected' : ''; ?>>Shared Room</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="rent_type" class="block text-sm font-medium text-gray-700">Rent Type</label>
                                    <div class="mt-1">
                                        <select id="rent_type" name="rent_type" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                            <option value="Daily" <?php echo $room['rent_type'] == 'Daily' ? 'selected' : ''; ?>>Daily</option>
                                            <option value="Monthly" <?php echo $room['rent_type'] == 'Monthly' ? 'selected' : ''; ?>>Monthly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <div class="mt-1">
                                        <select id="status" name="status" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                            <option value="Available" <?php echo $room['status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                            <option value="Booked" <?php echo $room['status'] == 'Booked' ? 'selected' : ''; ?>>Booked</option>
                                            <option value="Maintenance" <?php echo $room['status'] == 'Maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price (৳)</label>
                                    <div class="mt-1">
                                        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($room['price']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                    <div class="mt-1">
                                        <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($room['location']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="beds" class="block text-sm font-medium text-gray-700">Beds</label>
                                    <div class="mt-1">
                                        <input type="number" name="beds" id="beds" value="<?php echo htmlspecialchars($room['beds']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="baths" class="block text-sm font-medium text-gray-700">Baths</label>
                                    <div class="mt-1">
                                        <input type="number" name="baths" id="baths" value="<?php echo htmlspecialchars($room['baths']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="sqft" class="block text-sm font-medium text-gray-700">Sqft</label>
                                    <div class="mt-1">
                                        <input type="number" name="sqft" id="sqft" value="<?php echo htmlspecialchars($room['sqft']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <div class="mt-1">
                                        <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border border-gray-300 rounded-md p-2"><?php echo htmlspecialchars($room['description']); ?></textarea>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700">Amenities</label>
                                    <div class="mt-2 grid grid-cols-2 gap-4 sm:grid-cols-4">
                                        <?php 
                                        $currentAmenities = !empty($room['amenities']) ? explode(',', $room['amenities']) : [];
                                        $allAmenities = ['Wifi', 'Kitchen', 'Air conditioning', 'Heating', 'Washer', 'Dryer', 'Parking', 'Gym'];
                                        foreach ($allAmenities as $amenity): 
                                        ?>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="<?php echo strtolower(str_replace(' ', '', $amenity)); ?>" name="amenities[]" value="<?php echo $amenity; ?>" type="checkbox" <?php echo in_array($amenity, $currentAmenities) ? 'checked' : ''; ?> class="focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="<?php echo strtolower(str_replace(' ', '', $amenity)); ?>" class="font-medium text-gray-700"><?php echo $amenity; ?></label>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                                <div class="sm:col-span-6">
                                    <label for="image" class="block text-sm font-medium text-gray-700">Image URL</label>
                                    <div class="mt-1">
                                        <input type="text" name="image" id="image" value="<?php echo htmlspecialchars($room['image']); ?>" class="shadow-sm focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <a href="/?page=admin_rooms" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary mr-3">
                                    Cancel
                                </a>
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Update Room
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>
