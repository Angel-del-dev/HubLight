$(document).ready(function(e) {
    $("#file-input").on("change",function() {
        let inpFile = $("#file-input");
        let previewImage = document.querySelector(".foto-perfil");

        let file = this.files[0];

        // Si hay un archivo seleccionado, crea un FileReader para poder leerlo, y lo enseña
        if(file) {
            const reader = new FileReader();

            reader.addEventListener("load",function() {
                previewImage.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);

            document.getElementById("btn").hidden=false;

        }
    });
});
