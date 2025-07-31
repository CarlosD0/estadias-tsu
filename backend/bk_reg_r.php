<?php
include 'conexion.php';  // Sentencia para incluir archivo de conexión.

if(isset($_POST['add-r'])){ // Si "add-r" del formulario ha sido declarada y su valor no es nulo, entonces...
        // si los campos del formulario contienen al menos un caracter...
    if(strlen($_POST['nombre'])>=1 &&  strlen($_POST['ingredientes'])>=1 && strlen($_POST['preparacion'])>=1
    && strlen($_POST['recomendacion'])>=1){
            // se crean nuevas variables a las que se le asigna el valor que ingresa el usuario en el formulario con el método POST
        $nom=$_POST['nombre'];
        $ingr=$_POST['ingredientes'];
        $prep=$_POST['preparacion'];
        $reco=$_POST['recomendacion'];

        $archivo=$_FILES['imagen'];
        $tmp=$archivo['tmp_name'];
        $img=addslashes(file_get_contents($tmp));

            // se crea una consulta de mySQL, tabla receta para insertar los valores correspondientes
        $consulta="INSERT INTO receta(nombre_r, ingredientes_r, preparacion_r, imagen_r, recomendacion_r) VALUES('$nom','$ingr','$prep','$img','$reco')";
            
        mysqli_query($conexion,$consulta); // se realiza la consulta a la base de datos
        mysqli_close($conexion);// se cierra la conexión antes hecha

            // mensaje de alerta de javascript para indicar que se creó la receta correctamente correctamente.
        echo '<script type="text/javascript">alert("Convocatoria creada.");
        window.location.href="../Admin_Recetas.php";
        </script>';
    }
}
?>