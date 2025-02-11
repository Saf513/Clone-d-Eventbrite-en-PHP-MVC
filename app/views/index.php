<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
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

            <div class="auth-buttons">
                <a href="/login" class="auth-button login">Log In</a>
                <a href="/signup" class="auth-button register">Sign Up</a>
            </div>
        </div>
    </nav>
</body>
</html>