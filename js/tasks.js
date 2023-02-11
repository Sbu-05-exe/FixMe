const closeIcon = document.getElementById('close-icon');
const closeIconContainer = document.getElementById('close-icon-container');
const modalBody = document.querySelector('body');
const orderPartForm = document.getElementById('order-part');
const jobTableRows = document.querySelectorAll('#repair-job-table .selectable');
const orderButton = document.getElementById('order-button')
const selectStatusInput = document.getElementById('status');
const hiddenStatusChangedIndicatorInput = document.getElementById('status-changed');

let selectedJobRow = null

const initialValues = {
    status: selectStatusInput.value
}

selectStatusInput.onchange = e => {

    let value = ""
    Object.keys(selectStatusInput.children).forEach(i => {
        if (selectStatusInput[i].selected) {
            value = selectStatusInput[i].value;
        }

    })

    if (initialValues.status !== value) {
        hiddenStatusChangedIndicatorInput.value = "true";
        // console.log('the status is different')
    } else {
        hiddenStatusChangedIndicatorInput.value = "false";
        // console.log('the status is the same')
    }
}

// console.log();
closeIcon.style.display = "none"


orderButton.onclick = e => {
    // console.log('clicked the body');
    modalBody.classList.add('modal-body');
    e.stopPropagation();
    orderPartForm.classList.remove('hide');
    closeIconContainer.classList.remove('hidden');
    closeIcon.style.display = "block";

}

closeIcon.onclick = e => {
    // console.log('clicked the modal body');
    modalBody.classList.remove('modal-body');
    orderPartForm.classList.add('hide');
    closeIconContainer.classList.add('hidden');
    closeIcon.style.display = "none";
}

modalBody.onclick = e => {
    // console.log('clicked the modal body');
    modalBody.classList.remove('modal-body');
    orderPartForm.classList.add('hide');
    closeIconContainer.classList.add('hidden');
    closeIcon.style.display = "none";

}

orderPartForm.onclick = e => {
e.stopPropagation();
}

jobTableRows.forEach(tableRow => {
    tableRow.onclick = e => {
        const jobNo =  tableRow.children[0].innerText;
        // jobId.value = username;
        tableRow.classList.add("selected");
        // if (selectedJobRow) {
        //     selectedJobRow.classList.remove("selected");
        // }
        selectedJobRow = tableRow;
        window.location = "./tasks.php?id="+jobNo; 
    };   
})