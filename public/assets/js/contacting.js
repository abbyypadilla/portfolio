document.getElementById('contactForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    const responseMessage = document.getElementById('responseMessage');

    if (!name || !email || !message) {
        responseMessage.textContent = 'All fields are required!';
        responseMessage.className = 'alert alert-danger';
        responseMessage.style.display = 'block';
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        responseMessage.textContent = 'Invalid email format!';
        responseMessage.className = 'alert alert-danger';
        responseMessage.style.display = 'block';
        return;
    }

    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('message', message);

    fetch('/contact', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            responseMessage.innerHTML = `
                <strong>Thank you, ${name}!</strong> 
                Message sent: <em>"${message}"</em>
            `;
            responseMessage.className = 'alert alert-success';
            responseMessage.style.display = 'block';
        } else {
            responseMessage.textContent = 'There was an error sending your message. Please try again later.';
            responseMessage.className = 'alert alert-danger';
            responseMessage.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        responseMessage.textContent = 'There was an error sending your message. Please try again later.';
        responseMessage.className = 'alert alert-danger';
        responseMessage.style.display = 'block';
    });
});
