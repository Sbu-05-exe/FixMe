const allInputs = document.querySelectorAll('#profile-form input');
const profileSubmitButton = document.getElementById("save-profile");
const firstnameInput = document.getElementById('firstname');
const lastnameInput = document.getElementById('lastname');
const emailInput = document.getElementById('email');


const initialValues = {
	// setting initial values to know to check against when enabling or disable save button
	firstname: firstnameInput.value,
	lastname: lastnameInput.value,
	email: emailInput.value

}


firstnameInput.oninput = e => {
	// only enable the save button if at least one input is different to its initial values
	if (!(e.target.value === initialValues.firstname)) {
		initialValues.isDifferent = true;
	} else {
		if (initialValues.lastname !== lastnameInput.value || initialValues.email !== emailInput.value) {
			initialValues.isDifferent = true;
		} else {
			initialValues.isDifferent = false;
		}
	}

	if (initialValues.isDifferent) {
		profileSubmitButton.disabled = false;
	} else {
		profileSubmitButton.disabled = true;
	}
}

lastnameInput.oninput = e => {
	// only enable the save button if at least one input is different to its initial values
	if (!(e.target.value === initialValues.lastname)) {
		initialValues.isDifferent = true;
	} else {
		if (initialValues.firstname !== firstnameInput.value || initialValues.email !== emailInput.value) {
			initialValues.isDifferent = true;
		} else {
			initialValues.isDifferent = false;
		}
	}

	if (initialValues.isDifferent) {
		profileSubmitButton.disabled = false;
	} else {
		profileSubmitButton.disabled = true;
	}
}

emailInput.oninput = e => {
	// only enable the save button if at least one input is different to its initial values
	if (e.target.id = "email") {
		console.log('email input')
		if (!(e.target.value === initialValues.email)) {
			initialValues.isDifferent = true;
		} else {
			if (initialValues.firstname !== firstnameInput.value || initialValues.firstname !== firstnameInput.value) {
				initialValues.isDifferent = true;
			} else {
				initialValues.isDifferent = false;
			}
		}
	}

	if (initialValues.isDifferent) {
		profileSubmitButton.disabled = false;
	} else {
		profileSubmitButton.disabled = true;
	}
}

