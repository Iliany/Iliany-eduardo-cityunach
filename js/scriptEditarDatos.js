$('#actualizarProducto').on('click', function () {

    var idPro = $('#editIdPro').val();
    var nombre = $('#editNomPro').val();
    var precio = $('#editPrecioP').val();
    var existencia = $('#editExistenciaP').val();

    if (nombre === '' || precio === '' || existencia === '') {
        alert('Todos los campos son obligatorios');
        return;
    }

    $.ajax({
        url: 'controller/actualizar.php', 
        type: 'POST',
        data: {
            editIdPro: idPro,
            editNomPro: nombre,
            editPrecioP: precio,
            editExistenciaP: existencia
        },
        success: function (response) {
            $('#editarProductoModal').modal('hide');
            $('#modalActualizar').modal('show');

            // Redirigir después de que el usuario haga clic en "Aceptar"
            $('#modalAceptar').off('click').on('click', function() { // Corregido aquí
                window.location = 'dashboard.php';
            });
        },
        error: function () {
            alert('Error al actualizar el producto');
        }
    });
});
