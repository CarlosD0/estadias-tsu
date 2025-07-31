<?php
 $host="localhost";
 $user="root";
 $password="";
 $database="integradora";

     //$user="becaspap_becaspap";
     //$password="29demayo00R";
     //$database="becaspap_integradora";

  $conexion=mysqli_connect($host,$user,$password,$database);
    if(!$conexion)
    {
      echo "No se establecio la conexion con la base de datos, error: ".mysqli_connect_error();
    }

?>