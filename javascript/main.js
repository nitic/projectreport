
// Validate form inputs
const validateInput = (username, password) => {
    if (!username || !password) {
        showError("All fields are required.");
        return false;
    }
    if (password.length < 6) {
        showError("Password must be at least 6 characters.");
        return false;
    }
    return true;
};

// Handle Registration
document.getElementById("registerForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = document.getElementById("registerUsername").value.trim();
    const password = document.getElementById("registerPassword").value.trim();

    if (!validateInput(username, password)) return;

    showLoading();
    const response = await fetch(`${API_BASE}/register.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password }),
    });

    closeLoading();
    const result = await response.json();
    result.status === "success" ? showSuccess(result.message) : showError(result.message);
});

// Handle Login
document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = document.getElementById("loginUsername").value.trim();
    const password = document.getElementById("loginPassword").value.trim();

    if (!validateInput(username, password)) return;

    showLoading();
    const response = await fetch(`${API_BASE}/login.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password }),
    });

    closeLoading();
    const result = await response.json();
    if (result.status === "success") {
        //showSuccess(result.message);
        window.location.replace("dashborad.html");
    } else {
        showError(result.message);
    }
});

