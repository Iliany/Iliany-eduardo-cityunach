<?php
include('../conexionBD.php');
$con = conectaDB();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editIdPro']) && isset($_POST['editNomPro']) && isset($_POST['editPrecioP']) && isset($_POST['editExistenciaP'])) {
    // Obtener los datos
    $idPro = $_POST['editIdPro'];
    $nombre = $_POST['editNomPro'];
    $precio = $_POST['editPrecioP'];
    $existencia = $_POST['editExistenciaP'];

    $sql = "UPDATE tb_productos SET Nombre = '$nombre', Precio = '$precio', Ext = '$existencia' WHERE idPro = '$idPro'";

    // Ejecutar la consulta y manejar el resultado
    if (mysqli_query($con, $sql)) {
        header("Location: ../dashboard.php"); 
        exit(); 
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($con);
    }
}
?>
