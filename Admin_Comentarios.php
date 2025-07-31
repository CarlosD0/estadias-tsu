<?php
    // Retomar sesión activa.
session_start();
    // Se establece el número de errores repotados en 0.
error_reporting(0);

    // Declarar una variable igual al valor del indice 'nombre' en el array de la sesión.
$validar_nom=$_SESSION['nombre'];
$validar_rol=$_SESSION['rol'];

    // Si, la variable $validar, esta vacia o contiene espacios en blanco, entonces...
if($validar_nom==null || $validar_nom=="" || $validar_rol==2){
    header('Location: index.php'); // se redirecciona hacia la página de inicio.
    die(); // Termina el proceso.
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Becas | Administrar Comentarios</title>

    <!-- Libreria Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Libreria FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Libreria GoogleFonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <!-- Estilos Propios -->
  <link rel="stylesheet" type="text/css" href="css/estilos_admin.css">

</head>
<body> <!-- <> -->

<?php
  include 'Navbar_Admin.php';
?>

<section class="d-flex" style="justify-content: center; padding:40px 10%; font-family:'Source Serif Pro';">
    <!-- Titulo -->
  <h2 style="color:#446600; font-weight:bold;">Comentarios</h2>
</section>

<main class="cont-re-trad sombra">
  <pre style="font-size: 1rem;">
  <table class="table table-responsive table-bordered border-dark" id="tabla-re" style="font-family:'Source Serif Pro';">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Mensaje</th>
        <th scope="col">Usuario</th>
        <th scope="col">Fecha de envío</th>
        <th scope="col">Opciones</th> 
      </tr>
    </thead>
    <tbody>
    <?php
      include 'backend/conexion.php';

      $consulta="SELECT comentario.id_c, comentario.mensaje, comentario.fecha_c, usuario.nombre_u
      FROM comentario INNER JOIN usuario ON comentario.id_autor=usuario.id_u;";

      $comentario=mysqli_query($conexion, $consulta);

      if($comentario->num_rows>0){
        while($fila=mysqli_fetch_array($comentario)){
    ?>
      <tr>
        <td> <?php echo $fila['id_c'] ?> </td>
        <td> <?php echo $fila['mensaje'] ?> </td>
        <td> <?php echo $fila['nombre_u'] ?> </td>
        <td> <?php echo $fila['fecha_c'] ?> </td>
        <td>
            <!-- Botón Mostrar Comentario -->
          <a class="btn btn-primary" data-bs-toggle="modal" href="#MOD-ver-c<?php echo $fila['id_c']; ?>" role="button">
            <i class="fa-solid fa-eye"></i>
          </a>
            <!-- Botón Borrar Comentario -->
          <a class="btn btn-danger" data-bs-toggle="modal" href="#MOD-borrar-c<?php echo $fila['id_c']; ?>" role="button">
            <i class="fa-solid fa-trash-can"></i>
          </a>
            <!-- Inicio Modal Mostrar Comentario -->
          <div class="modal fade" id="MOD-ver-c<?php echo $fila['id_c']; ?>" aria-hidden="true" aria-labelledby="Modal-SobreNosotros-Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Modal Mostrar Comentario -->
                <div class="modal-header" style="background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                  <h5 class="modal-title" id="Modal-SobreNosotros-Label">Comentario</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Modal Mostrar Comentario -->
                <div class="modal-body" style="text-align:center; color:#523114;">
                    <!-- Información del equipo -->
                  <h4><?php echo $fila['mensaje'] ?></h4>
                </div>
                  <!-- Footer Modal Mostrar Comentario -->
                <div class="modal-footer" style="background-color:rgb(43,43,43); color:wheat;">
                  <p>Autor: <?php echo $fila['nombre_u'] ?></p>
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Mostrar Comentario -->

            <!-- Inicio Modal Borrar Comentario -->
          <div class="modal fade" id="MOD-borrar-c<?php echo $fila['id_c']; ?>" aria-hidden="true" aria-labelledby="MOD-borrar-c-Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Borrar Comentario -->
                <div class="modal-header" style="background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                  <h5 class="modal-title" id="MOD-borrar-c-Label">¡Advertencia!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Borrar Comentario -->
                <div class="modal-body" style="text-align:center; color:#523114;">
                    <!-- Advertencia -->
                  <h3>¿Deseas eliminar el mensaje <br> de forma permanente?</h3>
                    <!-- Inicio del formulario borrar comentario -->
                  <form id="form-borrar-c<?php echo $fila['id_c'] ?>" action="backend/bk_accion.php" method="POST" >
                      <!-- Inputs ocultos -->
                    <input type="hidden" name="id" value="<?php echo $fila['id_c'] ?>">
                    <input type="hidden" name="accion" value="borrar_c">
                  </form>
                    <!-- Fin del formulario borrar comentario -->
                </div>
                  <!-- Footer Borrar Comentario -->
                <div class="modal-footer" style="background-color:rgb(43,43,43);">
                    <!-- Botón eliminar -->
                  <input type="submit" form="form-borrar-c<?php echo $fila['id_c'] ?>" class="btn btn-danger" value="Eliminar">
                    <!-- Botón cancelar -->
                  <button class="btn btn-success" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Borrar Comentario -->
        </td>
      </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>
  </pre>
</main>

  <!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>