// Obtener elementos
var modal = document.getElementById("gifModal");
var modalImg = document.getElementById("img01");
var downloadLink = document.getElementById("downloadBtn"); // Actualizar según el nuevo botón de descarga
var closeModal = document.getElementById("closeModal");

// Función para abrir el modal con el GIF seleccionado
function openModal(imgSrc, downloadSrc) {
    modal.style.display = "block";
    modalImg.src = imgSrc;
    downloadLink.href = downloadSrc; // Aquí se establece la URL de descarga directa
}

// Cerrar el modal al hacer clic en (x)
closeModal.onclick = function() {
    modal.style.display = "none";
}

// Cerrar el modal al hacer clic fuera de la imagen
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
