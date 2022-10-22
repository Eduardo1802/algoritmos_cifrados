<?php

    $servidor = "localhost";
    $user = "u454376638_ultimo";
    $psw = "Lalo1234";  
    $bd = "u454376638_cifrados";
    
    $conn = mysqli_connect($servidor,$user,$psw,$bd);

    if(mysqli_connect_errno()){
        //echo'{"response":"0","message":"Error de conexion"}';
    }else{
        mysqli_set_charset($conn,"utf8");
    }
   
?>