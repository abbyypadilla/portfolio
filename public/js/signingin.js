document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    const formData = new FormData(this);

    fetch('/signin', {
        method: 'POST',
        body: formData, 
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok.');
            }
            return response.json(); 
        })
        .then(data => {
            if (data.success) {
                const successMessage = document.getElementById('successMessage');
                successMessage.style.display = 'block';
                successMessage.textContent = data.message || 'Login successful!';
            } else {
                const errorMessage = document.getElementById('errorMessage');
                errorMessage.style.display = 'block';
                errorMessage.textContent = data.message || 'Login failed.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
