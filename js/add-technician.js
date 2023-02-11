console.log('hooked up');
const firstNameInput = document.getElementById("firstname");
const salaryInput = document.getElementsByName("salary"); 
const surnameInput = document.getElementById("surname");
const emailInput = document.getElementById("email");
const confirmInput = document.getElementById("confirm");
const passwordInput = document.getElementById("password");
const allInputs = document.querySelectorAll("input");

const registerForm = document.getElementById("register-form");



const handleInputChange = (e) => {
    if (e.target.classList.contains("error")) {

        e.target.classList.remove('error');
        const selector = '.' + e.target.id + '';
        const tableData = document.querySelector(selector);
        // tableData.style.padding = " 0 "
        tableData.removeChild(tableData.lastElementChild);
        // console.log(inputLabel);
    }

}

const addErrorMessage = (e, message) => {
    const errorMessage = document.createElement('p');
    
        // grab the label of the input 


        const selector = '.' + e.target.id + '';
        const tableData = document.querySelector(selector);
        // console.log(tableData);

        e.target.classList.add('error');

        // tableData.style.border = "1px solid red";
        errorMessage.className="error";
        errorMessage.style.position = "absolute";
        errorMessage.style.color = "red"
        // tableData.style.padding = "0 0 1.5rem 0";
        tableData.append(errorMessage);
        errorMessage.innerText = message;
}

const handleInputFocusOut = (e) => {
    const hasBeenFlagged = e.target.classList.contains("error");
    if (!hasBeenFlagged) {
        // console.log(e.target);
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
        } else if (e.target.id = "salary") {
            if (e.target.valueAsNumber < 3000) {
                addErrorMessage(e, "Salary cannot be lower than 3000")
            }
        }
    } 
}


allInputs.forEach( (inputElement) => {

    inputElement.addEventListener("focusout", e => handleInputFocusOut(e));
    // display error message if input is empty

    inputElement.addEventListener("keydown", e => handleInputChange(e));
    // remove error message once you start trying to fix it
})