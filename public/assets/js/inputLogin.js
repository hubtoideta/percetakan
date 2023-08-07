function hapusSpasiUsername() {
    var inputNama = document.getElementById("no-space-username").value;
    var namaTanpaSpasi = inputNama.replace(/\s/g, ''); // Menghapus semua spasi dari input
    document.getElementById("no-space-username").value = namaTanpaSpasi.toLowerCase();
}
function hapusSpasiEditEmail() {
    var inputNama = document.getElementById("emailaddress").value;
    var namaTanpaSpasi = inputNama.replace(/\s/g, ''); // Menghapus semua spasi dari input
    document.getElementById("emailaddress").value = namaTanpaSpasi.toLowerCase();
}
function hapusSpasiEmail() {
    var inputNama = document.getElementById("no-space-email").value;
    var namaTanpaSpasi = inputNama.replace(/\s/g, ''); // Menghapus semua spasi dari input
    document.getElementById("no-space-email").value = namaTanpaSpasi.toLowerCase();
}


// Toggle
const button = document.querySelector("#kt_page_loading_overlay");

// Handle toggle click event
button.addEventListener("click", function() {
    // Populate the page loading element dynamically.
    // Optionally you can skipt this part and place the HTML
    // code in the body element by refer to the above HTML code tab.
    const loadingEl = document.createElement("div");
    document.body.prepend(loadingEl);
    loadingEl.classList.add("page-loader");
    loadingEl.classList.add("flex-column");
    loadingEl.classList.add("bg-dark");
    loadingEl.classList.add("bg-opacity-25");
    loadingEl.innerHTML = `
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
    `;

    // Show page loading
    KTApp.showPageLoading();

    // Hide after 3 seconds
    setTimeout(function() {
        KTApp.hidePageLoading();
        loadingEl.remove();
    }, 4000);
});
