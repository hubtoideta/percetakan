function hapusSpasiUsername() {
    var inputNama = document.getElementById("no-space-username").value;
    var namaTanpaSpasi = inputNama.replace(/\s/g, ''); // Menghapus semua spasi dari input
    document.getElementById("no-space-username").value = namaTanpaSpasi;
}
function hapusSpasiEmail() {
    var inputNama = document.getElementById("no-space-email").value;
    var namaTanpaSpasi = inputNama.replace(/\s/g, ''); // Menghapus semua spasi dari input
    document.getElementById("no-space-email").value = namaTanpaSpasi;
}