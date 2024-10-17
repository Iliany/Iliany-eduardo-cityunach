$(document).ready(function () {
    $('.eliminar').on('click', function (e) {
        e.preventDefault(); // Evitar que el enlace realice su acción predeterminada
        const nombreProducto = $(this).data('nombre'); // nombre del producto a eliminar(data-nombre: dashboard.php)

       
        $.ajax({
            type: "GET",
            url: 'controller/eliminar.php',
            data: {
                Nombre: nombreProducto 
            },
            success: function (res) {
                if (res == "1") {
                    $('#modalEliminar').modal('show'); 

                } else {
                    alert("Error al eliminar el producto. Intente de nuevo.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX: ", status, error);
                alert("Ocurrió un error. Por favor, intente más tarde.");
            }
        });
    });

   
    $('#EliminarModal').on('click', function() {
        window.location = 'dashboard.php'; 
    });
});
