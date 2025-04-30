<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Plateforme</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #f8f9fa;
            --success-color: #4BB543;
            --info-color: #2196F3;
            --warning-color: #FFC107;
            --danger-color: #F44336;
            --light-color: #f8f9fc;
            --dark-color: #212529;
            --body-bg: #f5f7fe;
            --card-border-radius: 16px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: var(--body-bg);
            color: #5d6778;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 1000px;
            margin: 0 auto;
            border-radius: var(--card-border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            background: #fff;
        }

        .left-panel {
            background: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            color: white;
            padding: 3rem;
            border-radius: var(--card-border-radius) 0 0 var(--card-border-radius);
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: 0;
        }

        .left-panel-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            width: 180px;
            height: 180px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2rem auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .brand-logo i {
            font-size: 4rem;
            color: white;
        }

        .welcome-text {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }

        .welcome-subtext {
            text-align: center;
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .register-text {
            text-align: center;
            font-size: 1rem;
            margin-top: 2rem;
        }

        .register-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: var(--transition);
        }

        .register-link:hover {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
        }

        .register-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: white;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .register-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .right-panel {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 2.5rem;
        }

        .login-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #718096;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 1rem;
            background-color: #f8fafc;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-left: 3rem;
        }

        .input-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            z-index: 10;
        }

        .toggle-password {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background: none;
            border: none;
            color: #a0aec0;
            cursor: pointer;
            transition: var(--transition);
        }

        .toggle-password:hover {
            color: var(--primary-color);
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #718096;
        }

        .form-check-input {
            border-color: #cbd5e0;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-login i {
            transition: transform 0.3s ease;
        }

        .btn-login:hover i {
            transform: translateX(4px);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: #a0aec0;
            font-size: 0.9rem;
        }

        .divider::before, .divider::after {
            content: '';
            height: 1px;
            background-color: #e2e8f0;
            flex-grow: 1;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .btn-social {
            background-color: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem;
            color: #4a5568;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .btn-social:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-social i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }

        .btn-social.google i {
            color: #ea4335;
        }

        .btn-social.facebook i {
            color: #1877f2;
        }

        .btn-social.apple i {
            color: #000000;
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }

        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .forgot-password a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Floating animation for the logo */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Error message styling */
        .error-message {
            color: var(--danger-color);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        /* Success styling */
        .input-success .form-control {
            border-color: var(--success-color);
        }

        .input-success .input-icon {
            color: var(--success-color);
        }

        /* Error styling */
        .input-error .form-control {
            border-color: var(--danger-color);
        }

        .input-error .input-icon {
            color: var(--danger-color);
        }

        /* Custom checkbox styling */
        .custom-checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .login-container {
                margin: 1rem;
            }
        }

        @media (max-width: 768px) {
            .left-panel {
                border-radius: var(--card-border-radius) var(--card-border-radius) 0 0;
                padding: 2rem;
            }

            .right-panel {
                padding: 2rem;
            }

            .login-title {
                font-size: 1.8rem;
            }

            .welcome-text {
                font-size: 1.8rem;
            }

            .brand-logo {
                width: 120px;
                height: 120px;
                margin: 1rem auto;
            }

            .brand-logo i {
                font-size: 3rem;
            }
        }

        @media (max-width: 576px) {
            .social-buttons {
                flex-direction: column;
            }

            .social-buttons .btn-social {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row login-container">
            <!-- Left Panel -->
            <div class="col-lg-5 left-panel">
                <div class="left-panel-content">
                    <div class="text-center">
                        <h1 class="welcome-text">Bienvenue !</h1>
                        <p class="welcome-subtext">Connectez-vous pour accéder à votre espace personnel</p>
                    </div>

                    <div class="brand-logo floating">
                        <i class="bi bi-briefcase"></i>
                    </div>

                    <div class="features-list mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Accédez à tous vos documents</div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Collaborez avec votre équipe</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Consultez vos statistiques</div>
                        </div>
                    </div>

                    <div class="register-text">
                        Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="register-link">Inscrivez-vous</a>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Login Form -->
            <div class="col-lg-7 right-panel">
                <div class="login-header">
                    <h2 class="login-title">Connexion</h2>
                    <p class="login-subtitle">Entrez vos identifiants pour accéder à votre compte</p>
                </div>

                <form id="loginForm" action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemple@domaine.com" required>
                        </div>
                        <div class="error-message" id="emailError"></div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label">Mot de passe</label>
                        </div>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="error-message" id="passwordError"></div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox" type="checkbox" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Rester connecté
                            </label>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}" class="forgot-link text-decoration-none">Mot de passe oublié ?</a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-login btn-primary w-100 d-flex align-items-center justify-content-center">
                        <span>Se connecter</span>
                        <i class="bi bi-arrow-right-short ms-2 fs-5"></i>
                    </button>

                    <!-- Social Login Divider -->
                    <div class="divider">ou connectez-vous avec</div>

                    <!-- Social Login Buttons -->
                    <div class="social-buttons d-flex gap-2">
                        <a href="#" class="btn btn-social google flex-grow-1">
                            <i class="bi bi-google"></i>
                            <span>Google</span>
                        </a>
                        <a href="#" class="btn btn-social facebook flex-grow-1">
                            <i class="bi bi-facebook"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="btn btn-social apple flex-grow-1">
                            <i class="bi bi-apple"></i>
                            <span>Apple</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });

        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            let isValid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            // Reset errors
            emailError.textContent = '';
            passwordError.textContent = '';
            email.parentElement.classList.remove('input-error', 'input-success');
            password.parentElement.classList.remove('input-error', 'input-success');

            // Email validation
            if (!email.value) {
                emailError.textContent = 'L\'adresse e-mail est requise';
                email.parentElement.classList.add('input-error');
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                emailError.textContent = 'Adresse e-mail invalide';
                email.parentElement.classList.add('input-error');
                isValid = false;
            } else {
                email.parentElement.classList.add('input-success');
            }

            // Password validation
            if (!password.value) {
                passwordError.textContent = 'Le mot de passe est requis';
                password.parentElement.classList.add('input-error');
                isValid = false;
            } else if (password.value.length < 8) {
                passwordError.textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                password.parentElement.classList.add('input-error');
                isValid = false;
            } else {
                password.parentElement.classList.add('input-success');
            }

            // If form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            } else {
                // Show loading state
                document.querySelector('.btn-login').innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Connexion en cours...';
                document.querySelector('.btn-login').disabled = true;
            }
        });

        // Animation effects for inputs
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-5px)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
