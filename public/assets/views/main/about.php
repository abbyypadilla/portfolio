<?php
session_start();
$env = parse_ini_file('../.env');
if (!$env) {
    die("Error: Unable to load .env file.");
}
$apiKey = $env['APIKEY'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/styles/aboutme.css">
    <script>
        const apiKey = "<?php echo $apiKey; ?>"; 
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apiKey; ?>&callback=initMap" async defer></script>
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
            <h1>About Me</h1>
        </header>
        <section class="content">
            <p>
                Hello World! 
                <br>
                I'm Abby, a current junior at Fordham, majoring in Computer Science and minoring in Economics.
                Through my internship at JLR, I utilize SQL and Python to create, automate, and optimize data pipelines to 
                ensure accurate and efficient results for a multitude of departments throughout the company. During my 
                time at Fordham, I continuously gain exposure to other programming languages, including C++, SwiftUI, 
                HTML, CSS, and JavaScript.
            </p>
        </section>
    </div>

    <div id="map" style="margin-top: 80px; height: 450px; width: 100%;"></div>
    
    <script>
        function initMap() {
            const school = { lat: 40.7710298, lng: -73.9850963 }; 
            const work = { lat: 41.0792097, lng: -74.1841702 }; 

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: school, 
            });

            new google.maps.Marker({
                position: school,
                map: map,
                title: "Fordham University - College",
            });

            new google.maps.Marker({
                position: work,
                map: map,
                title: "Jaguar Land Rover - Work",
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
