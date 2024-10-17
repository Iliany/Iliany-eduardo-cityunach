<?php
$nombre = $_POST['nomPro'];
$precio = $_POST['precioP'];
$existencia = $_POST['existenciaP'];

include('../conexionBD.php');
$con = conectaDB();
$sql ="insert into tb_productos values(DEFAULT,'".$nombre."',".$precio.",".$existencia.")";

mysqli_query($con,$sql);  

if(mysqli_affected_rows($con)>0){
	echo "1";
}
else{
	echo "2";  
} 
?>