<?php
$configargs=array(
    //"config"=> "C:/xampp/php/extras/openssl/openssl.cnf", // Argumentos para generar las llaves
    "config"=> "/opt/alt/openssl11/etc/pki/tls/openssl.cnf",
    'private_key_bits'=>2048,
    'default_md'=>"sha256",
);
$generar=openssl_pkey_new($configargs); // Creacion de las dos llaves 
openssl_pkey_export($generar,$keypriv, NULL, $configargs);// Exporta el contenido de la llave privada a la variable $keyprivada
$keypub=openssl_pkey_get_details($generar);//Obtiene los detalles de la llave para generar la llave publica.
file_put_contents('privada.key',$keypriv);
file_put_contents('publica.key',$keypub['key']);
echo "LLAVE PUBLICA Y PRIVADA CREADAS CORRECTAMENTE";
?>