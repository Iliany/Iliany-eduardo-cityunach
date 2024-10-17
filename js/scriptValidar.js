$(document).ready(function () {
    // Evento al hacer clic en el botón de guardar producto
    $('#guardarProducto').click(function () {
        // Obtener los valores del formulario
        let nombre = $("#nomPro").val();
        let precio = $("#precioP").val();
        let existencia = $("#existenciaP").val();

        // Verificar si los campos están vacíos
        if (nombre === "" || precio === "" || existencia === "") {
            alert("Por favor, rellene todos los campos.");
            return false;
        }

        // Realizar la solicitud AJAX
        $.ajax({
            type: "POST",
            url: "/CityUnach/controller/insertar.php",
            data: {
                nomPro: nombre,
                precioP: precio,
                existenciaP: existencia
            },
            success: function (res) {
                if (res == "1") {
                    $("#nomPro").val("");
                    $("#precioP").val("");
                    $("#existenciaP").val("");

                      // Ocultar el formulario
                      $('#exampleModal').hide(); // Asegúrate de que el ID sea correcto

                   
                    $('#modalExito').modal('show');

                    $('#aceptarModal').off('click').on('click', function() {
                        window.location = 'dashboard.php'; // Cambia esto si deseas redirigir a otra página
                    });
                } else {
                    alert("Error al guardar el producto. Intente de nuevo.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX: ", status, error);
                alert("Ocurrió un error. Por favor, intente más tarde.");
            }
        });

        return false;
    });
});
