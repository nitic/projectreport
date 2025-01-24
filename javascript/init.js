const API_BASE = "../api";

// SweetAlert2 helper functions
const showSuccess = (message) => Swal.fire("Success!", message, "success");
const showError = (message) => Swal.fire("Error!", message, "error");
const showLoading = () => Swal.fire({ title: "Processing...", allowOutsideClick: false, didOpen: () => Swal.showLoading() });
const closeLoading = () => Swal.close();


// Handle Logout
async function logout() {
    showLoading();
    const response = await fetch(`${API_BASE}/logout.php`);
    closeLoading();
    const result = await response.json();

    result.status === "success" ? window.location.replace("index.html") : showError(result.message);
}
