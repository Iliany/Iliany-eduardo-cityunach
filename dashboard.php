<?php
session_start();
if (!isset($_SESSION['login']))
	header("location: index.php");
?>
<html>

<head>
	<title>Sistema de Pruebas UNACH</title>
	<!-- Bootstrap core CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
	<link href="css/cmce-styles.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?> [ <?php echo $_SESSION['nom_completo']; ?>]</a>
			<a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
		</div>
	</nav>
	<center>
		<br><br><br><br>


		<form action="dashboard.php" method="GET">
			<div class="formpanel" id="f1">
				<b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
				<button class="btn btn-primary" type="submit">Buscar</button>
			</div>
		</form>

		<br><br>
		<hr>
		<br><br>

		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
			Nuevo Producto
		</button>

		<br><br>
		<?php

		include('conexionBD.php');
		$con = conectaDB();
		if (isset($_GET['pre']) == true)
			$sql = "select idPro,Nombre,Precio, Ext from tb_productos where Precio > " . $_GET['pre'];
		else
			$sql = "select idPro,Nombre,Precio, Ext from tb_productos";

		echo "<table class='table' style='width:570;'>";
		echo "<thead class='table-dark'>";
		echo "<th>Nombre</th>";
		echo "<th>Precio</th>";
		echo "<th></h>";
		echo "<th></h>";
		echo "</thead>";
		echo "<tbody>";

		$resultado = mysqli_query($con, $sql);
		while ($fila = mysqli_fetch_row($resultado)) {

			echo "<tr>";
			echo "<td>" . $fila[1] . "</td>";
			echo "<td>" . $fila[2] . "</td>";
			echo "<td><a href='#' class='eliminar' data-nombre='" . $fila[1] . "'><img src='iconoeliminar.png' width='30' heigth='30'></a></td>";
			echo "<td><a href='#' onclick='fillEditModal(" . $fila[0] . ", \"" . $fila[1] . "\", " . $fila[2] .  ", " . $fila[3] . ");' data-bs-toggle='modal' data-bs-target='#editarProductoModal'><img src='editar.png' width='30' height='30'></a></td>";
			echo "</tr>";
		}

		echo "</tbody> </table>";
		?>
		<br><br>
		<!-- Modal Ventada de Nuevo Producto -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3 mt-3">
							<label for="nomPro" class="form-label">Nombre del producto:</label>
							<input type="text" class="form-control" id="nomPro" required style="background-color: #F0F8FF; width: 90%;">
							<div class="mb-3 mt-3">
								<label for="precioP" class="form-label">Precio:</label>
								<input type="number" class="form-control" id="precioP" required style="background-color: #F0F8FF; width: 90%;">
							</div>
							<div class="mb-3 mt-3">
								<label for="existenciaP" class="form-label">Existencia:</label>
								<input type="number" class="form-control" id="existenciaP" required style="background-color: #F0F8FF; width: 90%;">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button type="button" id="guardarProducto" class="btn btn-success">Guardar </button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal de Éxito -->
		<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalExitoLabel">Confirmación de registro</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Producto guardado exitosamente.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="aceptarModal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal para editar/actualizar el producto -->
		<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editarProductoLabel">Editar producto</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="editIdPro"> <!-- Campo oculto para idPro -->
						<div class="mb-3 mt-3">
							<label for="editNomPro" class="form-label">Nombre del producto:</label>
							<input type="text" class="form-control" id="editNomPro" required style="background-color: #F0F8FF; width: 90%;">
						</div>
						<div class="mb-3 mt-3">
							<label for="editPrecioP" class="form-label">Precio:</label>
							<input type="number" class="form-control" id="editPrecioP" required style="background-color: #F0F8FF; width: 90%;">
						</div>
						<div class="mb-3 mt-3">
							<label for="editExistenciaP" class="form-label">Existencia:</label>
							<input type="number" class="form-control" id="editExistenciaP" required style="background-color: #F0F8FF; width: 90%;">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
						<button type="button" id="actualizarProducto" class="btn btn-success">Actualizar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal de actualizar -->
		<div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalActualizarLabel">Confirmación de registro actualizado</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Producto actualizado exitosamente.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="modalAceptar">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
		<!--Modal de eliminar-->
		<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalEliminarLabel">Confirmación de Eliminación</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Producto eliminado exitosamente.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="EliminarModal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>



	</center>

	<!-- Footer -->
	<footer class="footer bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white"><b> UC: Desarrollo de aplicaciones web y móviles [ Dr. Christian Mauricio Castillo Estrada ] </b></p>
		</div>
	</footer>
	<script src="js/scriptValidar.js"></script>
	<script src="js/scriptEditarDatos.js"></script>
	<script src="js/scriptcampos.js"></script>
	<script src="js/scriptEliminar.js"></script>
</body>

</html>