</main>

<footer class="bg-gray-900 text-white pt-12 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-1">
                <a href="#" class="text-2xl font-bold text-white flex items-center mb-4">
                    <i class="fas fa-home mr-2 text-primary"></i>RoomFinder
                </a>
                <p class="text-gray-400 text-sm mb-4">
                    Making it easy to find your perfect room. Affordable, comfortable, and verified listings.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/?page=home" class="hover:text-primary transition">Home</a></li>
                    <li><a href="/?page=rooms" class="hover:text-primary transition">Browse Rooms</a></li>
                    <li><a href="/?page=about" class="hover:text-primary transition">About Us</a></li>
                    <li><a href="/?page=contact" class="hover:text-primary transition">Contact Support</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Legal</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-primary transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-primary transition">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-primary transition">Cookie Policy</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                <p class="text-gray-400 text-sm mb-4">Subscribe to get the latest room updates.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Your email address" class="bg-gray-800 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
            &copy; <?php echo date('Y'); ?> RoomFinder. All rights reserved.
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const btn = document.querySelector('button[aria-controls="mobile-menu"]');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
</body>
</html>
