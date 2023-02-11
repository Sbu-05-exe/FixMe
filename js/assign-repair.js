const repairJobTableRows = document.querySelectorAll("#repair-job-table .selectable");
const technicanTableRows = document.querySelectorAll("#technician-table .selectable");
const selectTechnicianId = document.getElementById('technician-id')
const selectJobId = document.getElementById('job-id')

let selectedRepairJobRow = null;
let selectedTechnicianRow = null;

// console.log(technicanTableRows);

repairJobTableRows.forEach(tableRow => {
    tableRow.onclick = e => {

        if (!tableRow.classList.contains('selected')) {
            // if you clicking on an element that is already selected, do nothing

            const jobNo =  tableRow.children[0].innerText;

            // console.log(jobNo)

            selectJobId.value = jobNo;
            // selectJobId.options = 
            tableRow.classList.add("selected");
            if (selectedRepairJobRow) {
                selectedRepairJobRow.classList.remove("selected");
            }
            
            selectedRepairJobRow = tableRow;
            // window.location = "./assignment.php?id="+jobNo; 
        }
    };   
})

technicanTableRows.forEach(tableRow => {
    tableRow.onclick = e => {
        // select.value = devicename;
        if (!tableRow.classList.contains('selected')) {
            const technicianId =  tableRow.children[0].innerText;

            tableRow.classList.add("selected");
            selectTechnicianId.value = technicianId;
            if (selectedTechnicianRow) {
                selectedTechnicianRow.classList.remove("selected");
            }
            selectedTechnicianRow = tableRow;
        }
    };   
})

console.log(selectTechnicianId)
selectTechnicianId.onchange = (e) => {
    const username = selectTechnicianId.options[selectTechnicianId.selectedIndex].value;
    //window.location = "./assignment.php?username=" + username
}

