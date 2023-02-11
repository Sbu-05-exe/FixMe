const showOrHideIcon = document.getElementById("show-hide-icon");
const passwordInput = document.getElementById("password");

// show or hide password when click on eye icon
showOrHideIcon.onclick = (e) => {
    // changing the type of an input to text or password 
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute('type',type);

}