<?php
    include("conexion.php");

    if(isset($_POST['registrar'])){
        if(strlen($_POST['nombre']) >= 1 && strlen($_POST['apellido']) >= 1 && strlen($_POST['edad']) >= 1 &&  strlen($_POST['key']) >= 1 && strlen($_POST['email']) >= 1 && strlen($_POST['clave']) >= 1 ){
            $nombre=trim($_POST['nombre']);
            $apellido=trim($_POST['apellido']);
            $edad=trim($_POST['edad']);
            $email =trim($_POST['email']);
            $texto=trim($_POST['clave']);

            // echo $nombre."<br>";
            // echo $apellido."<br>";
            // echo $edad."<br>";
            // echo $email."<br>";
            // echo $texto."<br>";

            $texto=strtoupper($texto); // Convierte las letras a mayusculas
            $abc_base='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $n=strlen($texto);
            $mensaje_encriptado="";
            $desplaza = 4;
            for($i=0;$i<$n;$i++){
                $letra = $texto[$i];
                for($j=0;$j<=25;$j++){
                    if($letra == $abc_base[$j]){
                        break;
                    }
                }
                $npos = $j + $desplaza;
                if($npos <= 25){
                    //Asignar letra de aginascion
                    $mensaje_encriptado[$i] = $abc_base[$npos];
                }else{
                    $npos=$npos-26;
                    $mensaje_encriptado[$i] = $abc_base[$npos];
                }	            
            }
            for($i=0;$i<$n;$i++){
                $mensaje_encriptado[$i];
            }
            $consulta = "INSERT INTO tbl_personal(nombre,apellido,edad,correo,contra) VALUES ('$nombre','$apellido',$edad,'$email','$mensaje_encriptado');";
            $resultado = mysqli_query($conn,$consulta);
            if($resultado){
                $url = "https://uthh.online/algoritmos/cifrado_personal.php";
                $contenido = file_get_contents($url);
                echo $contenido;
            }   
        }else{
            ?><h3>¡Por Favor complete todos los campos!</h3> 
                <?php
        }  
    }    
        
    if(isset($_POST['cifrar'])){
        if(strlen($_POST['clave']) >= 1){
            $texto=trim($_POST['clave']);
            $texto=strtoupper($texto); // Convierte las letras a mayusculas
            $abc_base='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $n=strlen($texto);
            $mensaje_encriptado="";
            $desplaza = 4;
            for($i=0;$i<$n;$i++){
                $letra = $texto[$i];
                for($j=0;$j<=25;$j++){
                    if($letra == $abc_base[$j]){
                        break;
                    }
                }
                $npos = $j - $desplaza;
                if($npos >= 0){
                    //Asignar letra de aginascion
                    $mensaje_encriptado[$i] = $abc_base[$npos];
                }else{
                    $npos=$npos+26;
                    $mensaje_encriptado[$i] = $abc_base[$npos];
                }	            
            }
            for($i=0;$i<$n;$i++){
                $mensaje_encriptado[$i];
            }
            echo "<center style='margin-top: 15%;'><h1 style='justif: center;color: #1a2537;font-size: 40px;'>La contraseña es: ".$mensaje_encriptado."</h1>";
            echo"<a href='cifrado_personal.php' style='text-align: center;color: #1a2537;font-size: 40px;'> Regresar</a></center>";   
        }
    }
     
    

    
    
    
    
    
    
    
  


?>