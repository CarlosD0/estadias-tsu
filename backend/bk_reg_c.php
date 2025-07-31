<?php
include 'conexion.php';// Sentencia para incluir el archivo de la conexión

if(isset($_POST['add-com'])){// Si "add-com" del formulario ha sido declarada y su valor no es nulo, entonces...
    if(strlen($_POST['mensaje'])>=1 && strlen($_POST['autor'])>=1){// Si el campo 'mensaje' contiene al menos un caracter...

        $mensaje=$_POST['mensaje'];// Se crea la variable a la que se le asigna el valor que ingresó el usuario en el formulario con el método POST 
        $autor=$_POST['autor'];
        // Se crea una consulta de mySQL tabla comentario para insertar el valor
        $consulta="INSERT INTO comentario(mensaje,id_autor) VALUES('$mensaje','$autor')";
        mysqli_query($conexion,$consulta);// Se realiza la consulta a la BD
        mysqli_close($conexion);// Se cierra la conexión antes hecha
        // Mensaje de alerta de javascript para indicar que se envió el mensaje
        echo '<script type="text/javascript">alert("Mensaje enviado.");
        window.location.href="../index.php";
        </script>';
    }
}
?>