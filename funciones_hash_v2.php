<?php
    include("conexion.php");

    if(isset($_POST['registrar'])){
        if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['edad']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['clave']) >= 1 ){
            $nombre=trim($_POST['nombre']);
            $apellido=trim($_POST['apellido']);
            $edad=trim($_POST['edad']);
            $email =trim($_POST['email']);
            $clave=trim($_POST['clave']);
            $hash_v2 = sha1($clave);
            
            $consulta = "INSERT INTO tbl_hash_v2(nombre,apellido,edad,correo,contra) VALUES ('$nombre','$apellido','$edad','$email','$hash_v2');";
            $resultado = mysqli_query($conn,$consulta);
            if($resultado){
                $url = "https://uthh.online/algoritmos/cifrado_hash_v2.php";
                $contenido = file_get_contents($url);
                echo $contenido;
            }else{
                 ?><h3>Ups a ocurrido un error</h3>
                 <?php
            }
        }else{
            ?><h3>¡Por Favor complete todos los campos!</h3> 
                <?php
        }        
    }
?>