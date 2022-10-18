<?php
    include("conexion.php");

    function encrypt($data,$key){
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
        return base64_encode($encrypted."::".$iv);
    }

    function decrypt($data,$key){
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }

    if(isset($_POST['registro'])){
        if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['edad']) >= 1 &&  strlen($_POST['key']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['clave']) >= 1 ){
            $nombre=trim($_POST['nombre']);
            $apellido=trim($_POST['apellido']);
            $edad=trim($_POST['edad']);
            $key=trim($_POST['key']);
            $email =trim($_POST['email']);
            $clave=trim($_POST['clave']);
            
            $encriptado = encrypt($clave,$key);
            $desencriptado = decrypt($encriptado,$key);

            $consulta = "INSERT INTO tbl_aes(nombre,apellido,edad,_key,correo,contra,contra2) VALUES ('$nombre','$apellido','$edad','$key','$email','$encriptado','$desencriptado');";
            $resultado = mysqli_query($conn,$consulta);
            if($resultado){
                $url = "https://uthh.online/algoritmos/cifrado_aes.php";
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
        if(strlen($_POST['key']) >= 1 && strlen($_POST['clave']) >= 1 ){
            $key=trim($_POST['key']);
            $clave=trim($_POST['clave']);
           
            $desencriptado = decrypt($clave,$key);
            echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: #1a2537;font-size: 40px;'>La contraseña es: ".$desencriptado."</h1>";
            echo"<a href='cifrado_aes.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";   
        }      
    }


?>