<?php
if(isset($_POST['accion'])){// Si el valor de 'acción' extraído mediante el método POST no viene vacío, entonces...
    switch($_POST['accion']){// Se revisa el valor de 'acción', dependiendo el caso se ejecuta una función distinta y se termina el proceso
        case 'editar_r':
            editar_receta();
            break;
        case 'borrar_r':
            borrar_receta();
            break;
        case 'editar_v':
            editar_variante();
            break;
        case 'borrar_v':
            borrar_variante();
            break;
        case 'editar_u':
            editar_usuario();
            break;
        case 'borrar_u':
            borrar_usuario();
            break;
        case 'login':
            acceso_usuario();
            break;
        case 'borrar_c':
            borrar_comentario();
            break;
    }
}

function editar_receta(){
        // Incluir la conexión con la base de datos.
    require_once 'conexion.php';

        // Obtener las variables contenidas en el POST.
    extract($_POST);

    $archivo=$_FILES['archivo'];
    $tmp=$archivo['tmp_name'];
    $img=addslashes(file_get_contents($tmp));

        // Se crea una consulta de MYSQL para actualizar los datos de una fila en la tabla.
        // Se actualizaran los campos de la tabla 'receta', con sus respectivos valores, obtenidos con POST.
    $consulta="UPDATE receta SET nombre_r='$nombre', ingredientes_r='$ingredientes', preparacion_r='$preparacion', imagen_r='$img', recomendacion_r='$recomendacion' WHERE id_r='$id'";

        // Realiza la consulta (creada anteriormente) con la base de datos.
    mysqli_query($conexion,$consulta);
        // Redireccióm hacia la página donde se muestran los datos almacenados.
    header('location: ../Admin_Recetas.php');
}

function borrar_receta(){
        // Incluir la conexión con la base de datos.
    require_once 'conexion.php';

        // Obtener las variables contenidas en el POST.
    extract($_POST);

        // Se crea una consulta de MYSQL para actualizar los datos de una fila en la tabla.
        // Se eliminara, en la tabla 'receta', la fila con 'id_r' igual al valor de la variable $id obtenida con POST.
    $consulta="DELETE FROM receta WHERE id_r=$id";

        // Realiza la consulta (creada anteriormente) con la base de datos.
    mysqli_query($conexion,$consulta);
        // Redireccióm hacia la página donde se muestran los datos almacenados.
    header('location: ../Admin_Recetas.php');
}

function editar_variante(){
    require_once 'conexion.php';

    extract($_POST);

    $archivo=$_FILES['archivo'];
    $tmp=$archivo['tmp_name'];
    $img=addslashes(file_get_contents($tmp));

    $consulta="UPDATE variante SET nombre_v='$nombre', ingredientes_v='$ingredientes', preparacion_v='$preparacion', imagen_v='$img', recomendacion_v='$recomendacion', id_receta_orig='$seleccion', id_creador='$id_creador' WHERE id_v='$id'";
    mysqli_query($conexion,$consulta);

    if($_SESSION['rol']==1){
        header('location: ../Admin_Variantes.php');
    }else{
        header('location: ../Mis_Recetas.php');
    }
}

function borrar_variante(){
    require_once 'conexion.php';

    extract($_POST);

    $consulta="DELETE FROM variante WHERE id_v=$id";
    mysqli_query($conexion,$consulta);

    if($_SESSION['rol']==1){
        header('location: ../Admin_Variantes.php');
    }else{
        header('location: ../Mis_Recetas.php');
    }
}

function editar_usuario(){
    require_once 'conexion.php';

    extract($_POST);

    $consulta="UPDATE usuario SET nombre_u='$nombre', correo='$correo', contrasena='$contraseña', rol='$rol' WHERE id_u='$id'";
    mysqli_query($conexion,$consulta);

        // Se reanuda la sesión.
    session_start();
        // Se establece el número de errores repotados en 0.
    error_reporting(0);

    if($_SESSION['rol']==1){
        if($id=$_SESSION['id']){
            $_SESSION['nombre']=$nombre;
            $_SESSION['rol']=$rol;

            header('location: ../Admin_Usuarios.php');
        }else{
            header('location: ../Admin_Usuarios.php');
        }
    }elseif($_SESSION['rol']==2){
        $_SESSION['id']=$id;
        $_SESSION['nombre']=$nombre;
        $_SESSION['rol']=$rol;

        header('location: ../index.php');
    }
}

function borrar_usuario(){
    require_once 'conexion.php';

    extract($_POST);

    $consulta="DELETE FROM usuario WHERE id_u=$id";

    mysqli_query($conexion,$consulta);
    header('location: ../Admin_Usuarios.php');
}

function acceso_usuario(){
    // Se declaran variables y se obtiene su valor con POST.
$email=$_POST['correo'];
$pass=$_POST['contraseña'];

    // Se inicia una sesión.
session_start();

    // Incluir la conexión con la base de datos.
require_once 'conexion.php';

    // Se crea una consulta de MYSQL para buscar una fila de la tabla.
    // Se seleccionaran todos los campos de la tabla 'user', donde...
    // las columnas 'email' y 'password' sean iguales a las variables, respectivamente.
$consulta="SELECT * FROM usuario WHERE correo='$email' AND contrasena='$pass'";

    // Declarar la variable cuyo valor es el resultado de la consulta con la base de datos.
$resultado=mysqli_query($conexion,$consulta);
    // Se desglosa en filas el array que contiene el resultado de la consulta.
$fila=mysqli_fetch_array($resultado);

if ($fila) {
    // Si el nombre de usuario existe en la base de datos
    $row = $resultado->fetch_assoc();
    $storedPassword = $row['contrasena'];

    // Verificar la contraseña ingresada
    if (password_verify($contraseña, $storedPassword)) {
        // Contraseña correcta, inicio de sesión exitoso
        echo "Inicio de sesión exitoso.";
    } else {
        // Contraseña incorrecta
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    // El nombre de usuario no existe en la base de datos
    echo "Usuario o contraseña incorrectos.";
}






$_SESSION['id']=$fila['id_u'];
$_SESSION['nombre']=$fila['nombre_u'];
$_SESSION['rol']=$fila['rol'];

    // Si la fila existe entonces...
if($fila){
    if($fila['rol']==1){ // Si el 'rol' es igual a 1 entonces...
        header('Location: ../Admin_Recetas.php'); // se redirecciona hacia la página del administrador.
    }elseif($fila['rol']==2){ // Si el 'rol' es igual a 2 entonces...
        header('Location: ../index.php'); // se redirecciona hacia la página de inicio
    }
}else{ // De otro modo...
    header('Location: ../index.php'); // se redirecciona hacia la página de inicio.
    session_destroy(); // Se termina el proceso de la sesión activa.
}
}

function borrar_comentario(){
    require_once 'conexion.php';

    extract($_POST);

    $consulta="DELETE FROM comentario WHERE id_c=$id";

    mysqli_query($conexion,$consulta);
    header('location: ../Admin_Comentarios.php');
}
?>