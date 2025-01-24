
// Handle
document.getElementById("projectForm").addEventListener("submit", async (e) => {
   e.preventDefault();

    showLoading();
  
    let checkboxes = document.querySelectorAll('input[id^="ck-project-type"]:checked');
    const project_type_arr = Array.from(checkboxes).map(checkbox => checkbox.value);
    document.getElementById('project_type').value = JSON.stringify(project_type_arr);

    checkboxes = document.querySelectorAll('input[id^="ck-output-type"]:checked');
    const output_type_arr = Array.from(checkboxes).map(checkbox => checkbox.value);
    document.getElementById('output_type').value = JSON.stringify(output_type_arr);

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    console.log(data);
    const response = await fetch(`${API_BASE}/project.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    });

    closeLoading();
    const result = await response.json();
    result.status === "success" ? showSuccess(result.message) : showError(result.message);
    //console.log(result);
});