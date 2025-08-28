<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404</title>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@300;400;500;600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Google Sans', 'Roboto', Arial, sans-serif;
            background-color: #fafafa;
            color: #3c4043;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            padding: 2rem;
            text-align: center;
        }

        .error-animation {
            width: 280px;
            height: 200px;
            margin: 0 auto 2rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .error-animation img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .error-code {
            font-size: 6rem;
            font-weight: 300;
            color: #ea4335;
            margin-bottom: 1rem;
            letter-spacing: -2px;
        }

        .error-title {
            font-size: 2rem;
            font-weight: 400;
            color: #202124;
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 1.1rem;
            color: #5f6368;
            margin-bottom: 2.5rem;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: #1a73e8;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1557b0;
            box-shadow: 0 2px 8px rgba(26, 115, 232, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background-color: transparent;
            color: #1a73e8;
            border: 1px solid #dadce0;
        }

        .btn-secondary:hover {
            background-color: #f8f9fa;
            border-color: #1a73e8;
            color: #1a73e8;
            text-decoration: none;
        }

        .helpful-links {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e8eaed;
        }

        .helpful-links h3 {
            font-size: 1.1rem;
            font-weight: 500;
            color: #202124;
            margin-bottom: 1rem;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            text-align: left;
        }

        .link-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .link-item:hover {
            background-color: #f1f3f4;
        }

        .link-item a {
            color: #1a73e8;
            text-decoration: none;
            font-weight: 400;
        }

        .link-item a:hover {
            text-decoration: underline;
        }

        .icon {
            width: 20px;
            height: 20px;
            color: #5f6368;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .error-animation {
                width: 220px;
                height: 160px;
            }

            .error-code {
                font-size: 4rem;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .error-message {
                font-size: 1rem;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 200px;
                justify-content: center;
            }

            .links-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }

        /* Subtle animations */
        .error-container {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-container">
            <div class="error-animation">
                <img src="https://i.gifer.com/XVo6.gif" alt="Robot looking confused">
            </div>
            
            <div class="error-code">404</div>
            
            <h1 class="error-title">Page not found</h1>
            
            <p class="error-message">
                The page you're looking for doesn't exist. It might have been moved, deleted, or the URL might be incorrect.
            </p>
            
            <div class="button-group">
                <a href="/" class="btn btn-primary">
                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    Go to Homepage
                </a>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Go Back
                </a>
            </div>

          
        </div>
    </div>
</body>
</html>