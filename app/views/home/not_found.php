<!-- 404 Not Found Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | Eventbrite</title>
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

        .error-button {
            background-color: #d1410c;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .error-button:hover {
            background-color: #b73709;
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
        <img src="/api/placeholder/240/160" alt="404 illustration" class="error-image">
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-message">
            Uh oh, we can't seem to find the page you're looking for. Try going back to the previous page or find an event near you.
        </p>
        <a href="/" class="error-button">Find Events</a>
    </main>

    <footer class="footer">
        © 2025 Eventbrite
    </footer>
</body>
</html>

<!-- 401 Unauthorized Page -->
