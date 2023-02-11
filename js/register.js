

// this code just checks that the form inputs are not empty as all of them are required
// it also checks that the passwords are the same
const firstNameInput = document.getElementById("firstname");
const surnameInput = document.getElementById("surname");
const emailInput = document.getElementById("email");
const confirmInput = document.getElementById("confirm");
const allInputs = document.querySelectorAll("input");
const registerForm = document.getElementById("register-form");


const handleInputChange = (e) => {
    if (e.target.classList.contains("error")) {

        e.target.classList.remove('error');
        const selector = 'label[for="' + e.target.id + '"]';
        const inputLabel = document.querySelector(selector);
        inputLabel.style.padding = " 0 "
        inputLabel.removeChild(inputLabel.lastElementChild);
        // console.log(inputLabel);
    }

}

const addErrorMessage = (e, message) => {
    const errorMessage = document.createElement('p');
    
        // grab the label of the input 
        const selector = 'label[for="' + e.target.id + '"]';
        const inputLabel = document.querySelector(selector);
        // console.log(inputLabel);

        e.target.classList.add('error');

        // inputLabel.style.border = "1px solid red";
        errorMessage.className="error";
        errorMessage.style.position = "absolute";
        errorMessage.style.color = "red"
        inputLabel.style.padding = "0 0 1.5rem 0";
        inputLabel.append(errorMessage);
        errorMessage.innerText = message;
}

const handleInputFocusOut = (e) => {
    const hasBeenFlagged = e.target.classList.contains("error");
    if (!hasBeenFlagged) {
        if (!e.target.value) {
            // if input is empty
            if (!hasBeenFlagged) {
                // only do this if the input hasn't already been flagged to be an error
                addErrorMessage(e, "This field is required")
    
            }
        } else if (e.target.getAttribute("type") === "email") {
            // check that email is valid 
            
                
                const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
                
                if (!emailPattern.test(e.target.value)) {
        
                    addErrorMessage(e, "Invalid Email");                    
                }
        } else if (e.target.getAttribute("type") === "text") {
            // check that inputs aren't too short
                if (e.target.value.length < 2) {
                    addErrorMessage(e, "This value is too short")
                }
        } else if (e.target.id === "password") {
            if (e.target.value.length < 6 ) {
                addErrorMessage(e, "Password length must be at least 6 characters");
            }
        } else if (e.target.id === "confirm") {

            console.log(e.target.value);
            console.log(passwordInput.value);
            if (e.target.value !== passwordInput.value) {
                addErrorMessage(e, "Passwords do not match");
            }
        }
    } 
}

registerForm.onsubmit = e => {
    // e.preventDefault();

    // const valid = true;
    // allInputs.forEach( (inputElement) => {

    //     const hasBeenFlagged = inputElement.classList.contains("error");

    //     if (hasBeenFlagged) {
    //         inputElement.focus();
    //         return
    //     }  
    // })

    // registerForm.submit();
}




allInputs.forEach( (inputElement) => {

    inputElement.addEventListener("focusout", e => handleInputFocusOut(e));
    // display error message if input is empty

    inputElement.addEventListener("keydown", e => handleInputChange(e));
    // remove error message once you start trying to fix it
})