<?php
include("conexion.php");

if(isset($_POST['registrar'])){
    if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['edad']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['clave']) >= 1 ){
        $nombre=trim($_POST['nombre']);
        $apellido=trim($_POST['apellido']);
        $edad=trim($_POST['edad']);
        $email =trim($_POST['email']);
        $clave=trim($_POST['clave']);

        $key_publica = openssl_pkey_get_public(file_get_contents('publica.key'));
        openssl_public_encrypt($clave,$datos_cifrados,$key_publica);  // Metodo para cifrar los datos
        $dato_cifrado=base64_encode($datos_cifrados);
        
        $imprimir_public = file_get_contents('publica.key');
        $imprimir_secret = file_get_contents('privada.key');
        
        $consulta = "INSERT INTO tbl_rsa(nombre,apellido,edad,correo,contra,_key,_public) VALUES ('$nombre','$apellido','$edad','$email','$dato_cifrado','$imprimir_secret','$imprimir_public');";
        $resultado = mysqli_query($conn,$consulta);
        if($resultado){
            $url = "https://uthh.online/algoritmos/cifrado_rsa.php";
            $contenido = file_get_contents($url);
            echo $contenido;
        }else{
             ?><h3>Ups a ocurrido un error</h3>
             <?php
        }   

    }        
}

if(isset($_POST['cifrar'])){
    if(strlen($_POST['clave']) >= 1){ 
        $datos =trim($_POST['clave']); 
        $dato_cifrado=base64_decode($datos);
        $keyprivada=openssl_pkey_get_private(file_get_contents('privada.key'));
        openssl_private_decrypt($dato_cifrado,$datos_decifrados,$keyprivada);
        echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: #1a2537;font-size: 40px;'>La contraseña es: ".$datos_decifrados."</h1>";
        echo"<a href='cifrado_rsa.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";   
    }
}        
?>