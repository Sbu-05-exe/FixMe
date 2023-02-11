const deviceDivs = document.querySelectorAll(".device");
const addDeviceDiv = document.getElementById("add-device")
const deviceSubmitButton = document.getElementById("device-details-submit");
const deviceDeleteButton = document.getElementById("delete-device");
const deviceDetailsForm = document.getElementById("device-details-form");
const clickthrough = document.querySelectorAll('.element');
const deviceImageInput = document.getElementById('device-image');
const deviceImageHiddenInput = document.getElementById('img');
const deviceModelInput = document.getElementById('model');

const nameInput = document.getElementById('name');
const brandInput = document.getElementById('brand');
const categoryInput = document.getElementById('category');
const deviceIdInput = document.getElementById('device-id');
const addDeviceDetailsSection = document.querySelector(".device-details");
const addDeviceDetailsSectionTitle = document.getElementById("device-details-form-title");
/* deviceDeleteButton.onclick = (e) => {
	e.preventDefault();

	if (confirm("Are you sure you want ['" + nameInput.value + "'] ? ")) {

		deviceDetailsForm.submit();
	}
}
 */

deviceDivs.forEach(deviceDivElement => {
	deviceDivElement.onclick = (e) => {

		if (e.target.classList.contains('device')) {
			const captionDiv = e.target.children[1];

			const name = captionDiv.children[0].innerText;
			const brand = captionDiv.children[1].innerText;
			const category = captionDiv.children[2].innerText;
			const deviceId = captionDiv.children[3].innerText; // this element is hidden
			const src = captionDiv.children[4].innerText;
			const model = captionDiv.children[5].innerText;

			// const src = captionDiv.children[4].innerText; // this element is hidden
			 
			// deviceImageInput.value = src;

			// captionDiv.children.forEach( child => {

			// 	child.onclick = e.target.click()
			// })
			

			deviceDeleteButton.disabled = false;
			nameInput.value = name;
			brandInput.value = brand;
			deviceImageHiddenInput.value = src;
			deviceModelInput.value = model;

			if (category === 'laptop') {
				categoryIndex = 0;
				
			} else if (category === 'tablet') {
				categoryIndex = 1
			} else {
				categoryIndex = 2
			}

			categoryInput.selectedIndex = categoryIndex;

			deviceIdInput.value = deviceId;
			
			deviceSubmitButton.value = "save";
			deviceSubmitButton.setAttribute("name","save");

			addDeviceDetailsSection.style.display = "initial";
		} else {
			// what a workaround 
			deviceDivElement.click();
		}
	}
})


addDeviceDiv.onclick = (e) => {
	
	deviceDeleteButton.disabled = true;
	nameInput.value = "";
	brandInput.value = "";
	categoryInput.value = "laptop";
	deviceSubmitButton.value = "add";
	deviceModelInput.value = "";
	deviceImageHiddenInput.value = "undraw_monitor_iqpq.png";
	deviceSubmitButton.setAttribute("name", "add");
	addDeviceDetailsSection.style.display = "initial";

}

addDeviceDetailsSection.style.display = "none";

	