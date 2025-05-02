<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de mot de passe - Plateforme</title>
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

        .confirm-container {
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

        .right-panel {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .confirm-header {
            margin-bottom: 2.5rem;
        }

        .confirm-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .confirm-subtitle {
            color: #718096;
            font-size: 1rem;
            margin-bottom: 1.5rem;
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

        .btn-confirm {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn-confirm:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-confirm i {
            transition: transform 0.3s ease;
        }

        .btn-confirm:hover i {
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
            .confirm-container {
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

            .confirm-title {
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
        <div class="row confirm-container">
            <!-- Left Panel -->
            <div class="col-lg-5 left-panel">
                <div class="left-panel-content">
                    <div class="text-center">
                        <h1 class="welcome-text">Zone sécurisée</h1>
                        <p class="welcome-subtext">Veuillez confirmer votre mot de passe pour continuer</p>
                    </div>

                    <div class="brand-logo floating">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <div class="features-list mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Vérification de sécurité</div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Protection de vos données</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Accès aux fonctionnalités avancées</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Confirm Password Form -->
            <div class="col-lg-7 right-panel">
                <div class="confirm-header">
                    <h2 class="confirm-title">Confirmation</h2>
                    <p class="confirm-subtitle">Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.</p>
                </div>

                @if ($errors->get('password'))
                    <div class="alert alert-danger">
                        @foreach ($errors->get('password') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form id="confirmForm" method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="••••••••" required autocomplete="current-password">
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="error-message" id="passwordError"></div>
                    </div>

                    <!-- Confirm Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-confirm btn-primary d-flex align-items-center">
                            <span>Confirmer</span>
                            <i class="bi bi-arrow-right-short ms-2 fs-5"></i>
                        </button>
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
        document.getElementById('confirmForm').addEventListener('submit', function(event) {
            let isValid = true;
            const password = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');

            // Reset errors
            passwordError.textContent = '';
            password.parentElement.classList.remove('input-error', 'input-success');

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
                document.querySelector('.btn-confirm').innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Vérification...';
                document.querySelector('.btn-confirm').disabled = true;
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
