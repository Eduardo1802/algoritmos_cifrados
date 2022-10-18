<?php
    include("conexion.php");

    if(isset($_POST['registrar'])){
        if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['edad']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['clave']) >= 1 ){
            $nombre=trim($_POST['nombre']);
            $apellido=trim($_POST['apellido']);
            $edad=trim($_POST['edad']);
            $email =trim($_POST['email']);
            $clave=trim($_POST['clave']);
            // $hash_v2 = hash("sha256",$clave);
            $hash_v2 = sha1($clave);
            
            $consulta = "INSERT INTO tbl_hash_v2(nombre,apellido,edad,correo,contra,contra2) VALUES ('$nombre','$apellido','$edad','$email','$hash_v2','$clave');";
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

    if(isset($_POST['cifrar'])){
        if(strlen($_POST['clave']) >= 1 ){
            $clave=trim($_POST['clave']);

            $consulta = "SELECT contra2 FROM tbl_hash_v2 WHERE contra = '$clave'";
            $resultado = mysqli_query($conn,$consulta);
            $row = mysqli_fetch_row($resultado);
            // echo "$row[0]";
            echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: #1a2537;font-size: 40px;'>La contraseña es: ".$row[0]."</h1>";
            echo"<a href='cifrado_hash_v2.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";   
        }      
    }


    if(isset($_POST['verificar'])){
        if(strlen($_POST['clave']) >= 1 && strlen($_POST['clave_no']) >= 1){
            $clave=trim($_POST['clave']);
            $clave_no=trim($_POST['clave_no']);
            
            // $consulta = "SELECT contra,contra2 FROM tbl_hash_v1 WHERE contra = '4b87c5d0f7f4be62c8f5381104339e01' AND contra2= 'nadhi123'";
            $consulta = "SELECT contra,contra2 FROM tbl_hash_v2 WHERE contra = '$clave' AND contra2= '$clave_no'";
            $resultado = mysqli_query($conn,$consulta);
            
            if(!$resultado){
                echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: #1a2537;font-size: 40px;'>Datos incorrectos!</h1>";
                echo"<a href='cifrado_hash_v2.php' style='text-align: center;color: red;font-size: 40px;'> Regresar</a></center>";        
            }

            $row = mysqli_fetch_row($resultado);
                     
            if($row[0] == $clave && $row[1] == $clave_no){
                echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: green;font-size: 40px;'>La contraseña es correcta!</h1>";
                echo"<a href='cifrado_hash_v2.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";       
            }else{
                echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: red;font-size: 40px;'>Ups la contraseña es Incorrecta!</h1>";
                echo"<a href='cifrado_hash_v2.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";        
            }   
        }      
    }

?>