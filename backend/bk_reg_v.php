<?php

include 'conexion.php';

if(isset($_POST['add-v'])){
    if(strlen($_POST['nombre'])>=1 && 
    strlen($_POST['ingredientes'])>=1 && strlen($_POST['preparacion'])>=1
    && strlen($_POST['recomendacion'])>=1 && 
    strlen($_POST['seleccion'])>=1 && strlen($_POST['id_c'])>=1){
        $nom=$_POST['nombre'];
        $ingr=$_POST['ingredientes'];
        $prep=$_POST['preparacion'];
        $reco=$_POST['recomendacion'];
        $id_r=$_POST['seleccion'];
        $id_c=$_POST['id_c'];

        $archivo=$_FILES['imagen'];
        $tmp=$archivo['tmp_name'];
        $img=addslashes(file_get_contents($tmp));

        $consulta="INSERT INTO variante(nombre_v, ingredientes_v, preparacion_v, 
        imagen_v, recomendacion_v, id_receta_orig, id_creador)
        VALUES('$nom','$ingr','$prep','$img','$reco','$id_r','$id_c')";

        mysqli_query($conexion,$consulta);
        mysqli_close($conexion);

        echo '<script type="text/javascript">alert("Convocatoria creada.");
        window.location.href="../Mis_Recetas.php";
        </script>';
    }
}
?>