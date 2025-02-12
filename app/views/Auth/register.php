<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script>
        function toggleFields() {
            var accountType = document.querySelector('input[name="account_type"]:checked').value;
            if (accountType === 'founder') {
                document.getElementById('bio').style.display = 'block';
                document.getElementById('address').style.display = 'none';
                document.getElementById('phone').style.display = 'none';
            } else {
                document.getElementById('bio').style.display = 'none';
                document.getElementById('address').style.display = 'block';
                document.getElementById('phone').style.display = 'block';
            }
        }
    </script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Registration Form</h2>
        <form action="" method="POST">
            <!-- Full Name -->
            <div class="mb-4">
                <label for="full_name" class="block text-gray-700">Full Name:</label>
                <input type="text" id="full_name" name="full_name" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Account Type -->
            <div class="mb-6">
                <label class="block text-gray-700">Account Type:</label>
                <div class="flex items-center mb-2">
                    <input type="radio" id="member" name="account_type" value="member" onclick="toggleFields()" class="mr-2" required>
                    <label for="member" class="text-gray-700">Member</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="founder" name="account_type" value="founder" onclick="toggleFields()" class="mr-2">
                    <label for="founder" class="text-gray-700">Founder</label>
                </div>
            </div>

            <!-- Bio (Appears if Founder is selected) -->
            <div id="bio" class="mb-4" style="display:none;">
                <label for="bio" class="block text-gray-700">Bio:</label>
                <textarea id="bio_text" name="bio" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Address (Appears if Member is selected) -->
            <div id="address" class="mb-4" style="display:none;">
                <label for="address" class="block text-gray-700">Address:</label>
                <input type="text" id="address" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Phone (Appears if Member is selected) -->
            <div id="phone" class="mb-4" style="display:none;">
                <label for="phone" class="block text-gray-700">Phone:</label>
                <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit" class="w-full py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">Register</button>
            </div>
        </form>
    </div>

</body>
</html>
