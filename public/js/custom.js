function initializePage() {
    // Hide the profile-edit section on page load
    document.getElementById("profile-edit").style.display = "none";
}
function userposts(){
    document.getElementById("user-posts").style.display="block";
    document.getElementById("profile-edit").style.display="none";
    

}

function profileedit(){
    document.getElementById("user-posts").style.display="none";
    document.getElementById("profile-edit").style.display="block";

}




// //validating name while registering

// const nameInput = document.getElementById('name');
// const nameValidationError = document.getElementById('name-validation-error');

// nameInput.addEventListener('input', () => {
//     const nameValue = nameInput.value;

//     if (nameValue.length > 0) {

//         if (nameValue.length < 3) {
//             nameInput.classList.add('is-invalid');
//             nameValidationError.textContent = 'Name must be at least 3 characters.';
//         } else {
//             nameInput.classList.remove('is-invalid');
//             nameValidationError.textContent = '';
//         }
//     } else {
//         nameInput.classList.remove('is-invalid');
//         nameValidationError.textContent = '';
//     }
// });

// //validating username
// const usernameInput = document.getElementById('username');

// usernameInput.addEventListener('input', () => {
//     validateUsername(usernameInput);
// });

// function validateUsername(input) {
//     const validationError = document.getElementById('username-validation-error');
//     const username = input.value;

//     if (username.length < 5) {
//         input.classList.add('is-invalid');
//         validationError.textContent = 'Username must be at least 5 characters.';
//     } else if (!/^[a-zA-Z0-9]+$/.test(username)) {
//         input.classList.add('is-invalid');
//         validationError.textContent = 'Username must be alphanumeric.';
//     } else {
//         input.classList.remove('is-invalid');
//         validationError.textContent = '';
//     }
// }

// //validating email
// const emailInput = document.getElementById('email');

// emailInput.addEventListener('input', () => {
//     validateEmail(emailInput);
// });

// function validateEmail(input) {
//     const validationError = document.getElementById('email-validation-error');
//     const email = input.value;

//     if (!email.includes('@')) {
//         input.classList.add('is-invalid');
//         validationError.textContent = 'Email must contain "@" symbol.';
//     } else {
//         input.classList.remove('is-invalid');
//         validationError.textContent = '';
//     }
// }