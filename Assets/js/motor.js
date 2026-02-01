document.addEventListener("DOMContentLoaded", function() {

    var alerta = document.getElementById('alerta-flash');
    
    // 2. Si existe, activamos el temporizador
    if (alerta) {
        setTimeout(function() {
            
            // Paso A: Hacerla transparente y colapsarla
            alerta.style.opacity = "0";
            alerta.style.height = "0";
            alerta.style.padding = "0";
            
            // Paso B: Esperar 0.5s a que termine la animación visual y eliminarla del HTML
            setTimeout(function() {
                alerta.remove();
            }, 500);
            
        }, 3000); // 3000 milisegundos = 3 segundos de espera
    }
});

/* ================================
   PREVISUALIZACIÓN DE IMAGEN
   ================================ */
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('image-preview');
    var zone = document.getElementById('upload-zone');
    var content = document.getElementById('upload-content');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            // Asignamos la imagen cargada al src de la etiqueta img
            preview.src = e.target.result;
            preview.style.display = 'block';
            
            // Ocultamos el texto de "Arrastra aquí"
            content.style.display = 'none';
            
            // Añadimos clase para estilos extra
            zone.classList.add('has-image');
        }

        reader.readAsDataURL(input.files[0]);
    }
}