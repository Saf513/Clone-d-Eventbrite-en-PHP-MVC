<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Profile Details</h1>
    <form action="">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" value="John Doe" class="view-mode w-full p-2 border rounded" readonly><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="test@gmail.com" class="w-full p-2 border rounded" readonly><br>
        <label for="role">Role</label>
        <input type="text" id="role" name="role" value="Administrator" class="w-full p-2 border rounded" readonly><br>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="johndoe" class="view-mode w-full p-2 border rounded" readonly><br>
        <button type="submit">Save</button><br>
        <button type="reset">Reset</button><br>
    </form>
    <button id="editButton">Edit Profile</button>
<script>
        const editButton = document.getElementById('editButton');
        const fullName = document.getElementById('fullName');
        const email = document.getElementById('email');
        const role = document.getElementById('role');
        const username = document.getElementById('username');
        editButton.addEventListener('click', () => {
            fullName.removeAttribute('readonly');
            email.removeAttribute('readonly');
            role.removeAttribute('readonly');
            username.removeAttribute('readonly');
        });
    </script>
</body>
</html>