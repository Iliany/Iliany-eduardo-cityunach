<?php
include '../conexionBD.php';
$conn = conectaDB();

$Nombre = $_GET['Nombre'];

$sql = "DELETE FROM tb_productos WHERE Nombre='$Nombre'";

if ($conn->query($sql) === TRUE) {
    echo "1"; 

} else {
    echo "Error: " . $conn->error;
}

$conn->close();

exit();
?>
