<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Algoritmos de Cifrado</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
		<link rel="icon" type="image/png" href="icono.png">
	</head>
	<body><center>
		<ul class="menu" style="max-width: 67%;">
			<li><a href="aviso_privacidad.html">Portada</a></li>
			<li><a href="cifrado_aes.php">Cifrado simétrico AES</a></li>
			<li><a href="cifrado_rsa.php">Cifrado Asimétrico RSA</a></li>
			<li><a href="cifrado_hash_v1.php">Cifrado Hash - V1</a></li>
			<li><a href="cifrado_hash_v2.php">Cifrado Hash - V2</a></li>
			<li><a href="cifrado_personal.php">Cifrado Propio</a></li>
		</ul></center>
		<br><center><h1 Style="font-family: Helvetica;">Cifrado Hash - V2</h1></center>
		<form class="formulario" method="post" action="funciones_hash_v2.php">
			<!-- <h1>[1] Encriptar - SHA256</h1> -->
			<h1>[1] Encriptar - SHA1</h1>
			<div class="contenedor">
			<i class="fas icon">Nombre:</i>
				<div class="input-contenedor">
					<i class="fas fa-user icon"></i>
					<input type="text" placeholder="Ingresa tu nombre" name="nombre">
				</div>
				<i class="fas icon">Apellido Paterno:</i>
				<div class="input-contenedor">
					<i class="fas fa-user icon"></i>
					<input type="text" placeholder="Ingresa tu Apellido Paterno" name="apellido">
				</div>
				<i class="fas icon">Edad:</i>
				<div class="input-contenedor">
					<i class="fas fa-user icon"></i>
					<input type="number" min="0" max="150" style="font-size: 20px;width: 82%;padding: 10px; border: none;" placeholder="Ingresa tu edad" name="edad">
				</div>
				<i class="fas icon">Correo Electrónico:</i>
				<div class="input-contenedor">
					<i class="fas fa-envelope icon"></i>
					<input type="text" placeholder="Correo Electrónico" name="email">
				</div>
				<i class="fas icon">Contraseña:</i>
				<div class="input-contenedor">
					<i class="fas fa-key icon"></i>
					<input type="password" placeholder="Contraseña" name="clave">
				</div>	
				<input type="submit" value="Registrar (Encriptar)" class="button" name="registrar"><br><br>

				<!-- <center><a class="link" href="aviso_privacidad.html">Aviso de privacidad</a></center> -->
			</div>
		</form>
		<!-- <br><br>
		<form action="funciones_hash_v2.php" class="formulario" method="post">
			<h1>[2] Decifrar</h1>
			<div class="contenedor">
				<div class="input-contenedor">
					<i class="fas fa-key icon"></i>
					<input type="text" placeholder="Contraseña cifrada" name="clave">
				</div>	
				<input type="submit" value="Decifrar" class="button" name="cifrar"><br><br>
			</div>
		</form> -->
		<br><br>
		<form action="funciones_hash_v2.php" class="formulario" method="post">
			<h1>Verificar</h1>
			<div class="contenedor">
				<i class="fas icon">Contraseña no cifrada:</i>
				<div class="input-contenedor">
					<i class="fas fa-key icon"></i>
					<input type="password" placeholder="Ingresa la contraseña no cifrada" name="clave_no">
				</div>	
				<i class="fas icon">Contraseña cifrada:</i>
				<div class="input-contenedor">
					<i class="fas fa-key icon"></i>
					<input type="text" placeholder="Ingresa la contraseña cifrada" name="clave">
				</div>	
				<input type="submit" value="Verificar" class="button" name="verificar"><br><br>
			</div>
		</form>
		<h1>[3] Consultar Datos</h1><center>
		<div class="contenedor">
			<table class="table_planes">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Edad</th>
						<th>email</th>
						<th>contraseña cifrada</th>
						<!-- <th>contraseña decifrada</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					include("conexion.php");
					// $consulta = "SELECT id,correo,contra,contra2 FROM tbl_rsa";
					$consulta = "SELECT id,nombre,apellido,edad,correo,contra FROM tbl_hash_v2";
            		$resultado = mysqli_query($conn,$consulta);
					while($mostrar=mysqli_fetch_array($resultado)){
					?>
					<tr>
						<td><?php echo $mostrar['id']?></td>
						<td><?php echo $mostrar['nombre']?></td>
						<td><?php echo $mostrar['apellido']?></td>
						<td><?php echo $mostrar['edad']?></td>
						<td><?php echo $mostrar['correo']?></td>
						<td><?php echo $mostrar['contra']?></td>
						<!-- <td><?php echo $mostrar['contra2']?></td> -->
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div></center><br><br><br>
		<footer>
			<div class="container-body-all">
				<center>
					<div class="column1">
						<br><h3>Datos</h3>
						<p>Alumno: Eduardo Azuara Redondo</p>
						<p>Matricula: 20200744</p>	
						<p>Materia: Seguridad Informática</p>
						<p>Docente: MCE. Ana María Felipe Redondo</p>
						<h3></h3><br>
					</div>
				</center>
			</div>	
			<div class="container-footer">
				<div class="footer">
				</div>
			</div>		
		</footer>

    </body>
</html>