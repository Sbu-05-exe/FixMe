const selectRepairJob = document.getElementById('select-device');

selectRepairJob.onchange = e => {
    window.location = "repairs.php?id="+e.target.value;
}