<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <h1>Register</h1>
        </header>

        <section class="content">
            <p>Create your account below!</p>

            <div id="successMessage" class="alert alert-success" style="display: none;"></div>
            <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>

            <form id="registerForm" method="POST" action="/register" autocomplete="on">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required autocomplete="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required autocomplete="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password" required>
                </div>
                <button type="submit">Register</button>
            </form>
            <p class="login-link">Already have an account? <a href="/signin">Sign in here</a>.</p>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/registering.js"></script> 
</body>
</html>
