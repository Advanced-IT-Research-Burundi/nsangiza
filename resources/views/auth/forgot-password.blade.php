<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe - Plateforme</title>
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
            --light-color: #f8f7fc;
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

        .password-reset-container {
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

        .login-link-text {
            text-align: center;
            font-size: 1rem;
            margin-top: 2rem;
        }

        .login-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: var(--transition);
        }

        .login-link:hover {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.8);
        }

        .login-link::after {
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

        .login-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .right-panel {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .reset-header {
            margin-bottom: 2.5rem;
        }

        .reset-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .reset-subtitle {
            color: #718096;
            font-size: 1rem;
            line-height: 1.6;
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

        .btn-reset {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
            margin-top: 1.5rem;
        }

        .btn-reset:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-reset i {
            transition: transform 0.3s ease;
        }

        .btn-reset:hover i {
            transform: translateX(4px);
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

        /* Success message styling */
        .alert-success {
            background-color: rgba(75, 181, 67, 0.15);
            color: var(--success-color);
            border: 1px solid rgba(75, 181, 67, 0.3);
            border-radius: 10px;
            padding: 1rem;
        }

        /* Error alert styling */
        .alert-danger {
            background-color: rgba(244, 67, 54, 0.15);
            color: var(--danger-color);
            border: 1px solid rgba(244, 67, 54, 0.3);
            border-radius: 10px;
            padding: 1rem;
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

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .password-reset-container {
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

            .reset-title {
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
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row password-reset-container">
            <!-- Left Panel -->
            <div class="col-lg-5 left-panel">
                <div class="left-panel-content">
                    <div class="text-center">
                        <h1 class="welcome-text">Récupération</h1>
                        <p class="welcome-subtext">Réinitialisez votre mot de passe en toute simplicité</p>
                    </div>

                    <div class="brand-logo floating">
                        <i class="bi bi-key"></i>
                    </div>

                    <div class="features-list mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Procédure simple et sécurisée</div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Lien de réinitialisation par email</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Assistance disponible 24/7</div>
                        </div>
                    </div>

                    <div class="login-link-text">
                        Vous vous souvenez de votre mot de passe ? <a href="{{ route('login') }}" class="login-link">Connectez-vous</a>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Reset Form -->
            <div class="col-lg-7 right-panel">
                <div class="reset-header">
                    <h2 class="reset-title">Mot de passe oublié ?</h2>
                    <p class="reset-subtitle">Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation qui vous permettra de choisir un nouveau mot de passe.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="resetForm" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="exemple@domaine.com" required autofocus>
                        </div>
                        <div class="error-message" id="emailError"></div>
                    </div>

                    <!-- Send Reset Link Button -->
                    <button type="submit" class="btn btn-reset btn-primary w-100 d-flex align-items-center justify-content-center">
                        <span>Envoyer le lien de réinitialisation</span>
                        <i class="bi bi-arrow-right-short ms-2 fs-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        document.getElementById('resetForm').addEventListener('submit', function(event) {
            let isValid = true;
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');

            // Reset errors
            emailError.textContent = '';
            email.parentElement.classList.remove('input-error', 'input-success');

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

            // If form is not valid, prevent submission
            if (!isValid) {
                event.preventDefault();
            } else {
                // Show loading state
                document.querySelector('.btn-reset').innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Envoi en cours...';
                document.querySelector('.btn-reset').disabled = true;
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
