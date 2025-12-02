<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Your Cart</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($cartItems as $item): ?>
                        <li class="p-6 flex items-center">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" class="h-24 w-24 object-cover rounded-md">
                            <div class="ml-6 flex-1">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-medium text-gray-900"><?php echo $item['title']; ?></h3>
                                    <p class="text-lg font-bold text-gray-900">৳<?php echo $item['price'] * $item['hours']; ?></p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Duration: <?php echo $item['hours']; ?> hours</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex items-center border border-gray-300 rounded">
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                                        <span class="px-3 py-1 text-gray-900"><?php echo $item['hours']; ?></span>
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                                    </div>
                                    <button class="text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                    <div class="flow-root">
                        <dl class="-my-4 text-sm divide-y divide-gray-200">
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Subtotal</dt>
                                <dd class="font-medium text-gray-900">৳1000</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Service Fee</dt>
                                <dd class="font-medium text-gray-900">৳50</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-base font-bold text-gray-900">Order Total</dt>
                                <dd class="text-base font-bold text-gray-900">৳1050</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="mt-6">
                        <a href="/?page=checkout" class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-secondary">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
