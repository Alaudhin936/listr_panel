<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: #ffffff;
            border-radius: 20px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .logo svg {
            width: 40px;
            height: 40px;
            color: white;
        }
        
        .brand-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }
        
        .brand-subtitle {
            color: #718096;
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .form-section {
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: #4a5568;
        }
        
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 1rem 1.25rem;
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #2d3748;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #a0aec0;
        }
        
        .remember-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }
        
        .remember-me label {
            margin: 0;
            font-size: 0.875rem;
            color: #718096;
            cursor: pointer;
        }
        
        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .forgot-password:hover {
            color: #5a67d8;
        }
        
        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .error {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: #a0aec0;
            font-size: 0.875rem;
        }
        
        /* Animation for form appearance */
        .login-container {
            animation: slideIn 0.6s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                margin: 10px;
            }
            
            .logo {
                width: 70px;
                height: 70px;
            }
            
            .brand-name {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">
               <img src="{{asset('/assets/images/listrlogo.png')}}" style="width:100px;">
            </div>
            <h1 class="brand-name">Admin Login</h1>
        </div>
        
        <form class="form-section" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Enter your username" required>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="remember-section">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                
            </div>
            
            <button type="submit" class="login-btn">Sign In</button>
        </form>
        
      
    </div>
</body>
</html>