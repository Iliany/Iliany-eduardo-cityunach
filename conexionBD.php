<?php
function conectaDB() 
{ 
  	$host = 'sql303.infinityfree.com'; 
	$user = 'if0_37531836'; 
	$pass = 'i1s7hjCcEk';

   if (!( $link = @mysqli_connect($host,$user,$pass)) )
   {
      echo "Error al realizar la conexión a la base de datos.";
      exit();
   }

   if (!mysqli_select_db($link,"if0_37531836_miempresa")) 
   { 
      echo "Error al seleccionar la base de datos."; 
      exit(); 
   }    
   return $link; 
} 
?>