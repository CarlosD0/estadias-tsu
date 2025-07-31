<?php
include 'conexion.php'; // Sentencia para incluir el archivo de conexión.

if(isset($_POST['add-user'])){ // Si "add-user" del formulario ha sido declarada y su valor no es nulo, entonces...
        // Si los campos del formulario contienen al menos un caracter...
    if(strlen($_POST['nombre'])>=1 && strlen($_POST['correo'])>=1 &&
    strlen($_POST['contraseña'])>=1){
            // Se declaran variables asignandoles el valor que ingresa el usuario en el formulario con el método POST.
        $nombre=$_POST['nombre'];
        $correo=$_POST['correo'];
        $contraseña=$_POST['contraseña'];

            // Se crea la consulta de mySQL, tabla usuario para insertar los valores correspondientes.
        $consulta="INSERT INTO usuario(nombre_u, correo, contrasena, rol) VALUES('$nombre','$correo','$contraseña','2')";

        mysqli_query($conexion,$consulta); // Se realiza la consulta a la base de datos.
        echo mysqli_error($conexion);
        mysqli_close($conexion); // Se cierra la conexión antes hecha.

            // Mensaje de alerta de javascript para indicar que se creó el usuario corrextamente.
        echo '<script type="text/javascript">alert("Usuario creado, ahora puedes iniciar sesión.");
        window.location.href="../index.php";
        </script>';
    }
}
?>