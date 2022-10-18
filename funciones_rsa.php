<?php
include("conexion.php");

$configargs=array(
    //"config"=> "C:/xampp/php/extras/openssl/openssl.cnf", // Argumentos para generar las llaves
    "config"=> "/opt/alt/openssl11/etc/pki/tls/openssl.cnf",
    'private_key_bits'=>2048,
    'default_md'=>"sha256",
);
if(isset($_POST['registrar'])){
    if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['edad']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['clave']) >= 1 ){
        $generar=openssl_pkey_new($configargs); // Creacion de las dos llaves 
        openssl_pkey_export($generar,$keyprivada, NULL, $configargs); // Exporta el contenido de la llave privada a la variable $keyprivada
        $keypub=openssl_pkey_get_details($generar);//Obtiene los detalles de la llave para generar la llave publica.
       
        $nombre=trim($_POST['nombre']);
        $apellido=trim($_POST['apellido']);
        $edad=trim($_POST['edad']);
        $email =trim($_POST['email']);
        $clave=trim($_POST['clave']);
        $keypublica = $keypub['key']; 

        openssl_public_encrypt($clave,$datos_cifrados,$keypublica);  // Metodo para cifrar los datos
        
        $dato=base64_encode($datos_cifrados);
        $dato2=base64_decode($dato);

        openssl_private_decrypt($dato2,$datos_decifrados,$keyprivada); // Metodo para decifrar los datos
        
        // echo"Key privada: ".$keyprivada."<br><br>";
        // echo"Key publica: ".$keypublica."<br><br>"; 
        // echo"Email: ".$email."<br><br>";
        // echo "Datos cifrados: ".$datos_cifrados."<br><br>";
        // echo "Datos decifrados: ".$datos_decifrados."";
        $consulta = "INSERT INTO tbl_rsa(nombre,apellido,edad,_key,_public,correo,contra,contra2) VALUES ('$nombre','$apellido','$edad','$keyprivada','$keypublica','$email','$dato','$datos_decifrados');";
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
    if(strlen($_POST['clave']) >= 1 ){ // && strlen($_POST['_key']) >= 1 
        // $keyprivada = trim($_POST['_key']);
        $datos_cifrados =trim($_POST['clave']); 
        //echo"Key privada: ".$keyprivada."<br><br>";// ---->
        //echo "Datos cifrados: ".$datos_cifrados."<br><br>";// ---->
        $consulta = "SELECT contra2 FROM tbl_rsa WHERE contra = '$datos_cifrados'";
        $resultado = mysqli_query($conn,$consulta);
        $row = mysqli_fetch_row($resultado);
        // echo "$row[0]";
        echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: #1a2537;font-size: 40px;'>La contraseña es: ".$row[0]."</h1>";
        echo"<a href='cifrado_rsa.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";   
    }
}        
?>