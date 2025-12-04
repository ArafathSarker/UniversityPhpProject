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
                        <a href="/?page=user_dashboard" class="block px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="/?page=user_dashboard" class="block px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="fas fa-calendar-check mr-3"></i> My Bookings
                        </a>
                        <a href="#" onclick="alert('Favorites feature coming soon!'); return false;" class="block px-4 py-2 rounded-md text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                            <i class="fas fa-heart mr-3"></i> Favorites
                        </a>
                        <a href="/?page=user_settings" class="block px-4 py-2 rounded-md bg-primary text-white font-medium shadow-md">
                            <i class="fas fa-cog mr-3"></i> Settings
                        </a>
                        <hr class="my-2">
                        <a href="/?page=logout" class="block px-4 py-2 rounded-md text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:w-3/4">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Account Settings</h2>
                    
                    <?php if(isset($_GET['success'])): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">Your profile has been updated.</span>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_GET['error'])): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">
                                <?php 
                                    switch($_GET['error']) {
                                        case 'password_mismatch':
                                            echo 'New passwords do not match.';
                                            break;
                                        case 'current_password_required':
                                            echo 'Please enter your current password to change it.';
                                            break;
                                        case 'incorrect_password':
                                            echo 'The current password you entered is incorrect.';
                                            break;
                                        case 'update_failed':
                                            echo 'Failed to update profile. Please try again.';
                                            break;
                                        default:
                                            echo 'An unknown error occurred.';
                                    }
                                ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <form action="/?page=update_profile" method="POST" class="space-y-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="<?php echo explode(' ', $user['name'])[0]; ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="<?php echo explode(' ', $user['name'])[1] ?? ''; ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 text-gray-500 sm:text-sm cursor-not-allowed">
                            <p class="mt-1 text-xs text-gray-500">Email cannot be changed.</p>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                </div>

                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                </div>

                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary transition duration-150 ease-in-out">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
