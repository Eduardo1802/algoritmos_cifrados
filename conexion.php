<?php

    $servidor = "localhost";
    $user = "u454376638_Lalo";
    $psw = "Lalo1234";  
    $bd = "u454376638_algoritmos";
    
    $conn = mysqli_connect($servidor,$user,$psw,$bd);

    if(mysqli_connect_errno()){
        //echo'{"response":"0","message":"Error de conexion"}';
    }else{
        mysqli_set_charset($conn,"utf8");
    }
   
?>