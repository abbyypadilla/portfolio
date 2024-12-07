<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/styles/projects.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-cream sticky-top">
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
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/signin">Login</a></li>
                    <?php endif; ?>
        </ul>
    </div>

</nav>
    
    <h1>Portfolio</h1>

    <div id="projects-container">
    </div>
    
    <script>
        fetch('/portfolio/data')   
            .then(response => response.json())
            .then(data => {
                const projectsContainer = document.getElementById('projects-container');
                if (data.length > 0) {
                    data.forEach(project => {
                        const projectElement = document.createElement('div');
                        projectElement.classList.add('project');
                        projectElement.innerHTML = `
                            <h2>${project.title}</h2>
                            <p>${project.description}</p>
                            <img src="${project.image_url}" alt="${project.title} image">
                        `;
                        projectsContainer.appendChild(projectElement);
                    });
                } else {
                    const noProjectsMessage = document.createElement('p');
                    noProjectsMessage.classList.add('no-projects');
                    noProjectsMessage.textContent = 'No projects found.';
                    projectsContainer.appendChild(noProjectsMessage);
                }
            })
            .catch(error => {
                console.error('Error fetching portfolio data:', error);
            });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
