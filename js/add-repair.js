const usernameInput = document.getElementById('username');
const deviceNameInput = document.getElementById('devicename');
const selectDeviceSection = document.querySelector('.select-device');
const etcInput = document.getElementById('etc');
const submitButton = document.getElementById('submit');
const descriptionInput = document.getElementById('description');

const userTableRows = document.querySelectorAll("#user-table .selectable");
const deviceTableRows = document.querySelectorAll("#device-table .selectable");
let selectedUserRow = null;
let selectedDeviceRow = null;


usernameInput.onchange = (e) => {
    // usernameInput.selectedIndex;
    const username = usernameInput.options[usernameInput.selectedIndex].value;

    // window.location = "./index.php?username=" + username
}


// usernameInput.forEach(child => {
//     console.log(child)
// })
// usernameInput.onchange = (e) => {
//     // console.log(document.querySelector("option[selected]"));
//     // console.log('what do you mean');

//     console.log(e.target);
//     // console.log(e.target.options[e.selectedIndex].value);
// }

etc.onchange = e => {
    // if the user enters a negative value, set the value to 1 (which is the minimum that the value could be)
    // having an estimate repairt time of less than a day does not make sense

    if (e.target.value < 0) {
        e.target.value = 1;
    }
}

userTableRows.forEach(tableRow => {
    tableRow.onclick = e => {
        const username =  tableRow.children[2].innerText;
        usernameInput.value = username;
        tableRow.classList.add("selected");        


        
        if (selectedUserRow && selectedUserRow.children[2].innerText !== username ) {

            selectedUserRow.classList.remove("selected");
        
        }
        selectedUserRow = tableRow;
        window.location = "./index.php?username="+username; 
    };   
})

deviceTableRows.forEach(tableRow => {
    tableRow.onclick = e => {
        const devicename =  tableRow.children[0].innerText;

        deviceNameInput.value = devicename;
        tableRow.classList.add("selected");
        if (selectedDeviceRow) {
            selectedDeviceRow.classList.remove("selected");
        }

        if (descriptionInput.value.length > 3) { 
            submitButton.disabled = false;
        }

        selectedDeviceRow = tableRow;
        // window.location = "./index.php?username="+usernameInput.value+"&"+devicenameInput.value;
    };   
})

descriptionInput.oninput = (e) => {

    // console.log(e.target.value.length)
    if (usernameInput.value && devicename.value) {

        if (e.target.value.length > 3) {
            submitButton.disabled = false;   
        } else {
            submitButton.disabled = true;
        }
    }
}

submitButton.disabled = true;