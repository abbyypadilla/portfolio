document.getElementById('registerForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const formData = new FormData(this);

    fetch('/register', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();  
    })
    .then(data => {
        if (data.success) {
            document.getElementById('successMessage').innerText = data.message;
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('errorMessage').style.display = 'none';
        } else {
            document.getElementById('errorMessage').innerText = data.message;
            document.getElementById('errorMessage').style.display = 'block';
            document.getElementById('successMessage').style.display = 'none';
        }
    })
    .catch(error => {
        document.getElementById('errorMessage').innerText = 'There was an error with the registration. Please try again.';
        document.getElementById('errorMessage').style.display = 'block';
        console.error(error); 
    });
});
