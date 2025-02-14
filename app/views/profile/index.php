<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
        }

        .nav {
            background: #fff;
            padding: 16px 24px;
            box-shadow: 0 1px 0 rgba(0, 0, 0, .1);
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

        .profile-buttons {
            position: relative;
        }

        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 8px;
            overflow: hidden;
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #ddd;
        }

        .profile-form {
            max-width: 400px;
            margin: 80px auto 0;
            padding: 24px;
            border: 1px solid #dbdae3;
            border-radius: 8px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .profile-form label {
            font-weight: bold;
        }

        .profile-form input {
            padding: 12px;
            border: 1px solid #dbdae3;
            border-radius: 4px;
            font-size: 14px;
        }

        .update-profile {
            display: block;
            max-width: 400px;
            margin: 24px auto;
            padding: 12px 24px;
            border-radius: 4px;
            background-color: #d1410c;
            color: white;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .update-profile:hover {
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

        .save-profile {
            display: block;
            max-width: 400px;
            margin: 24px auto;
            padding: 12px 24px;
            border-radius: 4px;
            background-color: #1e0a3c;
            color: white;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            text-decoration: none;
        }
    </style>
</head>

<body>
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

            <div class="profile-buttons">
                <button class="profile-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                        <path d="M12 14c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z"></path>
                    </svg>
                </button>
                <div class="dropdown-menu">
                    <a href="/dashboard">Dashboard</a>
                    <a href="/profile">Profile</a>
                    <a href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <h1 style="text-align: center; margin-top: 100px;">Profile</h1>
        <form action="/profile/update" method="POST" class="profile-form">
            <legend>Personal Information</legend>
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user["full_name"]) ?>" readonly>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>" readonly disabled>

            <label for="role">Role</label>
            <input type="text" id="role" name="role" value="<?= htmlspecialchars($user["role"]) ?>" readonly disabled>

            <?php if ($user["role"] === "member"): ?>
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" 
                    value="<?= htmlspecialchars($additionalData["phone_number"] ?? '') ?>" readonly>

                <label for="address">Address</label>
                <textarea id="address" name="address" readonly><?= htmlspecialchars($additionalData["address"] ?? '') ?></textarea>
            <?php endif; ?>

            <?php if ($user["role"] === "founder"): ?>
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" readonly><?= htmlspecialchars($additionalData["bio"] ?? '') ?></textarea>
            <?php endif; ?>
        </form>

        <a href="#" class="update-profile">Update Profile</a>
        <a href="#" class="save-profile" style="display: none;">Save Profile</a>
    </main>

    <script>
        document.querySelector('.profile-btn').addEventListener('click', function() {
            var dropdown = document.querySelector('.dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.querySelector('.update-profile').addEventListener('click', function(event) {
            event.preventDefault();
            // Enable editing for editable fields only
            document.getElementById('full_name').removeAttribute('readonly');
            
            if (document.getElementById('phone_number')) {
                document.getElementById('phone_number').removeAttribute('readonly');
            }
            if (document.getElementById('address')) {
                document.getElementById('address').removeAttribute('readonly');
            }
            if (document.getElementById('bio')) {
                document.getElementById('bio').removeAttribute('readonly');
            }
            
            document.querySelector('.save-profile').style.display = 'block';
        });

        document.querySelector('.save-profile').addEventListener('click', function(event) {
            event.preventDefault();
            // Submit the form
            document.querySelector('.profile-form').submit();
        });
    </script>

</body>

</html>
