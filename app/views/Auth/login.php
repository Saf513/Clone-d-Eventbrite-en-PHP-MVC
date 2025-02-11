
<?php 


$_SESSION["user_id"] = "good";
$_SESSION["user_email"] = "good@gmail.com";
$_SESSION['user_role'] = 'user';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

  <div class="bg-white p-8 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login to Your Account</h2>

    <form action="#" method="POST" class="space-y-6">
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

      <!-- Submit Button -->
      <div>
        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
      </div>
    </form>

    <!-- Sign up Link -->
    <div class="mt-4 text-center">
      <p class="text-sm text-gray-600">Don't have an account? <a href="/register" class="text-blue-500 hover:underline">Sign up</a></p>
    </div>
  </div>

</body>
</html>
