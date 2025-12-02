<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Checkout Form -->
            <div class="lg:w-2/3">
                <form class="space-y-8">
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h2 class="text-xl font-medium text-gray-900 mb-6">Contact Information</h2>
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Email address</label>
                                <input type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First name</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last name</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h2 class="text-xl font-medium text-gray-900 mb-6">Payment Details</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Card number</label>
                                <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">CVC</label>
                                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm border p-2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center items-center px-6 py-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-primary hover:bg-secondary">
                        Confirm Payment ৳1050
                    </button>
                </form>
            </div>

            <!-- Order Summary (Compact) -->
            <div class="lg:w-1/3">
                <div class="bg-white shadow-lg rounded-lg p-6 sticky top-24">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                    <div class="flow-root">
                        <ul class="divide-y divide-gray-200 mb-4">
                            <li class="py-4 flex">
                                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80" alt="Room" class="h-16 w-16 object-cover rounded">
                                <div class="ml-4 flex-1">
                                    <h3 class="text-sm font-medium text-gray-900">Modern Studio</h3>
                                    <p class="text-sm text-gray-500">2 hours</p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">৳1000</p>
                            </li>
                        </ul>
                        <dl class="text-sm divide-y divide-gray-200 border-t border-gray-200 pt-4">
                            <div class="py-2 flex items-center justify-between">
                                <dt class="text-gray-600">Subtotal</dt>
                                <dd class="font-medium text-gray-900">৳1000</dd>
                            </div>
                            <div class="py-2 flex items-center justify-between">
                                <dt class="text-gray-600">Service Fee</dt>
                                <dd class="font-medium text-gray-900">৳50</dd>
                            </div>
                            <div class="py-2 flex items-center justify-between">
                                <dt class="text-base font-bold text-gray-900">Total</dt>
                                <dd class="text-base font-bold text-gray-900">৳1050</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
