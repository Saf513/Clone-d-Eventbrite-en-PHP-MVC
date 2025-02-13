<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .nav {
            background: #fff;
            padding: 16px 24px;
            box-shadow: 0 1px 0 rgba(0,0,0,.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1320px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            flex-shrink: 0;
        }

        .logo img {
            height: 32px;
            vertical-align: middle;
        }

        .search-container {
            flex: 1;
            max-width: 800px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px 12px 40px;
            border: 2px solid #dbdae3;
            border-radius: 24px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #1e0a3c;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6f7287;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .auth-button {
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .login {
            color: #1e0a3c;
        }

        .login:hover {
            color: #4b4d63;
            background-color: #f8f7fa;
        }

        .register {
            background-color: #d1410c;
            color: white;
        }

        .register:hover {
            background-color: #b73709;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                flex-wrap: wrap;
            }

            .search-container {
                order: 3;
                width: 100%;
                max-width: none;
            }

            .auth-buttons {
                flex-shrink: 0;
            }

            .auth-button {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="nav">
        <div class="nav-container">
            <a href="/" class="logo">
                <img src="/api/placeholder/120/32" alt="Eventbrite">
            </a>
            
            <div class="search-container">
                <svg class="search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search for events">
            </div>

            <div class="auth-buttons">
                <a href="/profile" class="auth-button login"><?php echo $_SESSION["user_name"]; ?></a>
                <a href="/logout" class="auth-button login">Logout</a>
            </div>
        </div>
    </nav>


    <!-- Main Dashboard Container -->
    <div class="min-h-screen flex flex-col pt-16">

        <!-- Main Content -->
        <div class="flex-grow p-6 space-y-6">

            <!-- Dashboard Statistics Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total Reservations -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Total Reservations</h3>
                    <p class="mt-2 text-4xl font-bold text-indigo-600">7</p>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Upcoming Booked Events</h3>
                    <p class="mt-2 text-4xl font-bold text-indigo-600">3</p>
                </div>

                <!-- Total Canceled Reservations -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Canceled Reservations</h3>
                    <p class="mt-2 text-4xl font-bold text-indigo-600">2</p>
                </div>

            </div>

            <!-- Additional Stats Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Most Reserved Category -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Most Reserved Category</h3>
                    <p class="mt-2 text-4xl font-bold text-indigo-600">Science</p>
                </div>

                <!-- Total Money Spent -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-700">Total Money Spent</h3>
                    <p class="mt-2 text-4xl font-bold text-indigo-600">$1,200</p>
                </div>

            </div>

        </div>


        <!-- Main Content -->
        <div class="flex-grow p-6 space-y-6">

            <!-- Page Title -->
            <div class="p-6 rounded-lg text-center">
                <h2 class="text-3xl font-semibold text-indigo-600">Event History</h2>
                <p class="mt-2 text-gray-600">Below is a list of all the events you've reserved.</p>
            </div>

            <!-- Event History List -->
            <div class="bg-white p-6 rounded-lg shadow-md space-y-2">

                <!-- Event 1 -->
                <div class="flex justify-between items-center p-5 border-b">
                    <div>
                        <h4 class="text-xl font-semibold text-indigo-600 mb-3">Music Festival 2025</h4>
                        <p class="text-gray-600">Date: March 22, 2025</p>
                        <p class="text-gray-600">Location: Madison Square Garden, New York</p>
                        <p class="text-gray-600">Category: Music</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-green-600">Completed</span>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="flex justify-between items-center p-5 border-b">
                    <div>
                        <h4 class="text-xl font-semibold text-indigo-600 mb-3">Tech Conference 2025</h4>
                        <p class="text-gray-600">Date: April 10, 2025</p>
                        <p class="text-gray-600">Location: Silicon Valley Conference Center</p>
                        <p class="text-gray-600">Category: Technology</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-red-600">Canceled</span>
                    </div>
                </div>

                <!-- Event 3 -->
                <div class="flex justify-between items-center p-5 border-b">
                    <div>
                        <h4 class="text-xl font-semibold text-indigo-600 mb-3">Cooking Workshop</h4>
                        <p class="text-gray-600">Date: April 25, 2025</p>
                        <p class="text-gray-600">Location: Culinary Arts Academy</p>
                        <p class="text-gray-600">Category: Cooking</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-blue-600">Attended</span>
                    </div>
                </div>

                <!-- Event 4 -->
                <div class="flex justify-between items-center p-5 border-b">
                    <div>
                        <h4 class="text-xl font-semibold text-indigo-600 mb-3">Yoga Retreat 2025</h4>
                        <p class="text-gray-600">Date: May 5, 2025</p>
                        <p class="text-gray-600">Location: Mountain Retreat, Colorado</p>
                        <p class="text-gray-600">Category: Yoga</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500">Pending</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>