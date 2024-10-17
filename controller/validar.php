<?php
// Iniciar la sesión
session_start();


include ('../conexionBD.php'); 

if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    
  
    $conn = conectaDB(); 

    $username = mysqli_real_escape_string($conn, $_POST['loginUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['loginPassword']);

   
    $query = "SELECT * FROM tb_usuarios WHERE NomUser = '$username' AND Passwd = '$password'";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
       
        $user = mysqli_fetch_assoc($result);
        
     
        $_SESSION['login'] = "true";
        $_SESSION['nomusuario'] = $user['NomUser'];
        $_SESSION['nom_completo'] = $user['Nom_completo'];  // Nueva variable de sesión

      
        echo json_encode(array('success' => 1));
    } else {
      
        echo json_encode(array('success' => 0));
    }

  
    mysqli_close($conn);
} else {
    echo json_encode(array('success' => 0));
}
?>
