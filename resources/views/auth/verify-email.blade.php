<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'email - Plateforme</title>
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

        .verification-container {
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

        .verification-header {
            margin-bottom: 2.5rem;
        }

        .verification-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .verification-subtitle {
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .success-message {
            background-color: rgba(75, 181, 67, 0.1);
            border-left: 4px solid var(--success-color);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            color: #2d3748;
        }

        .success-message i {
            color: var(--success-color);
            margin-right: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-primary i {
            margin-right: 0.5rem;
        }

        .btn-logout {
            color: #718096;
            background: none;
            border: none;
            font-size: 0.95rem;
            text-decoration: underline;
            transition: var(--transition);
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .btn-logout:hover {
            color: #2d3748;
            background-color: rgba(0, 0, 0, 0.05);
        }

        .btn-logout i {
            margin-right: 0.5rem;
        }

        .actions-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
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

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .verification-container {
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

            .verification-title {
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

            .actions-container {
                flex-direction: column;
                gap: 1rem;
            }

            .actions-container form {
                width: 100%;
            }

            .actions-container button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row verification-container">
            <!-- Left Panel -->
            <div class="col-lg-5 left-panel">
                <div class="left-panel-content">
                    <div class="text-center">
                        <h1 class="welcome-text">Vérification</h1>
                        <p class="welcome-subtext">Une dernière étape avant de commencer</p>
                    </div>

                    <div class="brand-logo floating">
                        <i class="bi bi-envelope-check"></i>
                    </div>

                    <div class="features-list mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Protection contre les accès non autorisés</div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Confirmation de votre identité</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div>Accès complet à toutes les fonctionnalités</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Email Verification -->
            <div class="col-lg-7 right-panel">
                <div class="verification-header">
                    <h2 class="verification-title">Vérification d'email</h2>
                    <p class="verification-subtitle">
                        Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n'avez pas reçu l'e-mail, nous pouvons vous en envoyer un autre.
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="success-message">
                        <i class="bi bi-check-circle-fill"></i>
                        Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.
                    </div>
                @endif

                <div class="actions-container">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-envelope"></i>
                            Renvoyer l'email de vérification
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
