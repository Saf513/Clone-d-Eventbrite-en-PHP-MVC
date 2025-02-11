<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Authorized | Eventbrite</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f8f7fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: #fff;
            padding: 16px;
            box-shadow: 0 1px 0 rgba(0,0,0,.1);
        }

        .header img {
            height: 32px;
        }

        .error-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            text-align: center;
        }

        .error-image {
            width: 240px;
            margin-bottom: 32px;
        }

        .error-title {
            font-size: 32px;
            font-weight: 700;
            color: #1e0a3c;
            margin-bottom: 16px;
        }

        .error-message {
            font-size: 16px;
            color: #6f7287;
            margin-bottom: 32px;
            max-width: 460px;
            line-height: 1.5;
        }

        .error-buttons {
            display: flex;
            gap: 16px;
        }

        .error-button {
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .error-button.primary {
            background-color: #d1410c;
            color: white;
        }

        .error-button.primary:hover {
            background-color: #b73709;
        }

        .error-button.secondary {
            background-color: transparent;
            color: #d1410c;
            border: 2px solid #d1410c;
        }

        .error-button.secondary:hover {
            background-color: rgba(209, 65, 12, 0.1);
        }

        .footer {
            background: #1e0a3c;
            color: #fff;
            padding: 24px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="/api/placeholder/120/32" alt="Eventbrite Logo">
    </header>

    <main class="error-container">
        <img src="/api/placeholder/240/160" alt="401 illustration" class="error-image">
        <h1 class="error-title">Not Authorized</h1>
        <p class="error-message">
            Looks like you don't have permission to access this page. Please sign in or create an account to continue.
        </p>
        <div class="error-buttons">
            <a href="/login" class="error-button primary">Sign In</a>
            <a href="/register" class="error-button secondary">Create Account</a>
        </div>
    </main>

    <footer class="footer">
        © 2025 Eventbrite
    </footer>
</body>
</html>