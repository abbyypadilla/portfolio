<?php
session_start(); 

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_unset();
    
    session_destroy();
    
    header("Location: /homepage");
    exit();  
}

require_once './../app/controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userController = new UserController();
    
    $loginResult = $userController->loginUser($username, $email, $password);

    if ($loginResult['success']) {
        $_SESSION['username'] = $loginResult['username']; 

        echo json_encode([
            'success' => true,
            'message' => 'Login successful!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid username/email or password.'
        ]);
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./assets/styles/registration.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-cream sticky-top">
        <div class="navbar-container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item"><a class="nav-link" href="/signin?logout=true">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/signin">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>

        <section class="content">
            <p>Sign into your account below!</p>

            <div id="successMessage" class="alert alert-success" style="display: none;"></div>
            <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>

            <form id="loginForm" method="POST" action="/signin" autocomplete="on">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" autocomplete="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" autocomplete="new-password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <p class="login-link">Don't have an account? <a href="/register">Register here</a>.</p>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/signingin.js"></script> 
    </body>
    </html>
<?php } ?>
