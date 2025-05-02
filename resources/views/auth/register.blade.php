<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #6c757d;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-color: #dee2e6;
            --bs-btn-box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
            --shadow-sm: 0 .125rem .25rem rgba(0,0,0,.075);
            --shadow-md: 0 .5rem 1rem rgba(0,0,0,.15);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .auth-card {
            width: 100%;
            max-width: 1000px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
            overflow: hidden;
            background-color: #fff;
        }

        .auth-row {
            display: flex;
            flex-wrap: wrap;
        }

        .auth-sidebar {
            flex: 0 0 100%;
            max-width: 100%;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            padding: 2.5rem;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .sidebar-logo {
            height: 50px;
            width: auto;
        }

        .sidebar-waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 25%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,192L48,186.7C96,181,192,171,288,186.7C384,203,480,245,576,240C672,235,768,181,864,181.3C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            z-index: 1;
        }

        .auth-content {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 2.5rem;
        }

        .auth-heading {
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: var(--dark-color);
        }

        .auth-subheading {
            font-size: 1rem;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .form-floating > label {
            padding: 0.75rem 1rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: var(--secondary-color);
            padding-right: 0;
        }

        .input-group .form-control {
            border-left: none;
            padding-left: 0.5rem;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .input-group:focus-within .form-control {
            border-color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: var(--bs-btn-box-shadow);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .btn-social {
            color: var(--dark-color);
            background-color: #fff;
            border: 1px solid var(--border-color);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: var(--transition);
            width: 100%;
            margin-bottom: 0.75rem;
            box-shadow: var(--shadow-sm);
        }

        .btn-social:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .social-icon {
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: var(--secondary-color);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .auth-footer a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            background: none;
            border: none;
            cursor: pointer;
            z-index: 10;
            font-size: 1rem;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--secondary-color);
            margin-top: 0.25rem;
        }

        .form-msg {
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .form-msg.error {
            color: #dc3545;
        }

        .form-msg.success {
            color: #198754;
        }

        .password-strength {
            height: 4px;
            margin-top: 0.5rem;
            border-radius: 2px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: var(--transition);
        }

        /* Responsive styles */
        @media (min-width: 768px) {
            .auth-sidebar {
                flex: 0 0 40%;
                max-width: 40%;
                border-radius: 1rem 0 0 1rem;
            }

            .auth-content {
                flex: 0 0 60%;
                max-width: 60%;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fadeInUp {
            animation: fadeInUp 0.5s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-row">
                <!-- Sidebar Section -->
                <div class="auth-sidebar">
                    <div>
                        <h3 class="mb-4 fadeInUp">Rejoignez notre communauté aujourd'hui !</h3>
                        <p class="mb-4 fadeInUp delay-1">Créez un compte pour accéder à toutes nos fonctionnalités exclusives et commencer à collaborer avec d'autres utilisateurs.</p>
                        <div class="d-flex align-items-center mb-4 fadeInUp delay-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2 text-light"></i>
                                <span>Accès complet à la plateforme</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4 fadeInUp delay-2">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2 text-light"></i>
                                <span>Stockage cloud sécurisé</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4 fadeInUp delay-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2 text-light"></i>
                                <span>Collaboration en temps réel</span>
                            </div>
                        </div>
                    </div>
                    <div class="fadeInUp delay-3">
                        <p class="mb-0">Déjà membre ? <a href="{{ route('login') }}" class="text-white fw-bold text-decoration-underline">Connectez-vous</a></p>
                    </div>
                    <div class="sidebar-waves"></div>
                </div>

                <!-- Form Section -->
                <div class="auth-content">
                    <h2 class="auth-heading">Créer un compte</h2>
                    <p class="auth-subheading">Remplissez le formulaire ci-dessous pour commencer</p>

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('terms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                    </div>

                    @enderror
                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom complet" required autofocus>
                            </div>
                            <div class="form-msg error d-none">Le nom est requis</div>
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@exemple.com" required>
                            </div>
                            <div class="form-msg error d-none">Veuillez entrer une adresse e-mail valide</div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group position-relative">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Créez un mot de passe fort" required>
                                <button type="button" class="password-toggle" id="passwordToggle">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="password-strength-meter" id="passwordStrength"></div>
                            </div>
                            <div class="form-hint">Le mot de passe doit contenir au moins 8 caractères, incluant des lettres majuscules, minuscules et des chiffres</div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
                            <div class="input-group position-relative">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                                <button type="button" class="password-toggle" id="confirmToggle">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-msg error d-none">Les mots de passe ne correspondent pas</div>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    J'accepte les <a href="#" class="text-decoration-none">conditions générales</a> et la <a href="#" class="text-decoration-none">politique de confidentialité</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="bi bi-person-plus-fill me-2"></i>Créer mon compte
                            </button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="auth-footer">
                        Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const togglePassword = (inputId, toggleBtnId) => {
                const input = document.getElementById(inputId);
                const toggleBtn = document.getElementById(toggleBtnId);

                toggleBtn.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);

                    // Toggle eye icon
                    const iconClass = type === 'password' ? 'bi-eye' : 'bi-eye-slash';
                    toggleBtn.querySelector('i').className = `bi ${iconClass}`;
                });
            };

            togglePassword('password', 'passwordToggle');
            togglePassword('password_confirmation', 'confirmToggle');

            // Password strength meter
            const passwordInput = document.getElementById('password');
            const strengthMeter = document.getElementById('passwordStrength');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;

                // Length check
                if (password.length >= 8) strength += 25;

                // Uppercase check
                if (/[A-Z]/.test(password)) strength += 25;

                // Lowercase check
                if (/[a-z]/.test(password)) strength += 25;

                // Number check
                if (/[0-9]/.test(password)) strength += 25;

                // Update meter
                strengthMeter.style.width = `${strength}%`;

                // Color based on strength
                if (strength < 25) {
                    strengthMeter.style.backgroundColor = '#dc3545'; // Danger
                } else if (strength < 50) {
                    strengthMeter.style.backgroundColor = '#ffc107'; // Warning
                } else if (strength < 75) {
                    strengthMeter.style.backgroundColor = '#fd7e14'; // Orange
                } else {
                    strengthMeter.style.backgroundColor = '#198754'; // Success
                }
            });

            // Form validation example
            const form = document.querySelector('form');
            const confirmPassword = document.getElementById('password_confirmation');
            const passwordError = confirmPassword.nextElementSibling.nextElementSibling;

            confirmPassword.addEventListener('input', function() {
                if (this.value !== passwordInput.value) {
                    passwordError.classList.remove('d-none');
                } else {
                    passwordError.classList.add('d-none');
                }
            });

            // Simple form submission validation
            form.addEventListener('submit', function(event) {
                if (passwordInput.value !== confirmPassword.value) {
                    event.preventDefault();
                    passwordError.classList.remove('d-none');
                }
            });
        });
    </script>
</body>
</html>
