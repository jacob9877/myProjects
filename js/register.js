document.addEventListener("DOMContentLoaded", function () {
	const loginForm = document.getElementById("loginForm");
	const errorMessage = document.getElementById("errorMessage");
	
	loginForm.addEventListener("submit", function (e) {
		e.preventDefault();
		
		const firstName = document.getElementById("firstName").value;
		const lastName = document.getElementById("lastName").value;
		const login = document.getElementById("login").value;
		const password = document.getElementById("password").value;
		const password2 = document.getElementById("password2").value;
		
		if (password === password2) {
			errorMessage.textContent = '';
			alert('Passwords match!');
			
			fetch("http://cop4331-project.online/LAMPAPI/CreateUser.php", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify({ firstName , lastName, login, password }),
			})
				.then((response) => response.json())
				.then((data) => {
					if (data.error) {
						errorMessage.textContent = data.error;
						errorMessage.style.display = "block";
					} else {
						window.location.assign("http://cop4331-project.online/registerSuccess.html");
					}
				}
				.catch((error) => {
					// Handle fetch errors
					errorMessage.textContent = 'An error occurred. Please try again later.';
					errorMessage.style.display = "block";
					console.error('Error:', error);
				});
		} else {
			errorMessage.textContent = 'Passwords do not match.';
			errorMessage.style.display = "block";
		}
		
	}