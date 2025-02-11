<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

  <div class="bg-white p-8 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Create an Account</h2>

    <form action="#" method="POST" class="space-y-6">
      <!-- Full Name -->
      <div>
        <label for="full-name" class="block text-gray-600 font-semibold">Full Name</label>
        <input type="text" id="full-name" name="full-name" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-gray-600 font-semibold">Email</label>
        <input type="email" id="email" name="email" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-gray-600 font-semibold">Password</label>
        <input type="password" id="password" name="password" required class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Account Type -->
      <div>
        <label class="block text-gray-600 font-semibold">Account Type</label>
        <div class="mt-2 flex gap-4">
          <label class="inline-flex items-center">
            <input type="radio" name="account-type" value="Member" class="form-radio text-blue-500" required>
            <span class="ml-2">Member</span>
          </label>
          <label class="inline-flex items-center">
            <input type="radio" name="account-type" value="Organizer" class="form-radio text-blue-500" required>
            <span class="ml-2">Organizer</span>
          </label>
        </div>
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
      </div>
    </form>
  </div>

</body>
</html>
