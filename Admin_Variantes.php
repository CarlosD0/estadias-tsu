<?php
    // Retomar sesión activa.
session_start();
    // Se establece el número de errores repotados en 0.
error_reporting(0);

    // Declarar una variable igual al valor del indice 'nombre' en el array de la sesión.
$validar_nom=$_SESSION['nombre'];
$validar_rol=$_SESSION['rol'];

    // Si, la variable $validar, esta vacia o contiene espacios en blanco, entonces...
if($validar_nom==null || $validar_nom=="" ){
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
  <title>Sabor Totonaco | Administrar Variantes</title>

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
  <h2 style="color:#446600; font-weight:bold;">Variantes</h2>
</section>

  <!-- Contenedor de la tabla -->
<main class="cont-re-trad sombra">
  <pre style="font-size: 1rem;">
  <table class="table table-responsive table-bordered border-dark" id="tabla-re" style="font-family:'Source Serif Pro';">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Ingredientes</th>
        <th scope="col">Preparación</th>
        <th scope="col">Imagen</th>
        <th scope="col">Recomendaciones</th>
        <th scope="col">Receta Original</th>
        <th scope="col">ID Creador</th>
        <th scope="col">Fecha</th>
        <th scope="col">Opciones</th> 
      </tr>
    </thead>
    <tbody>
    <?php
      include 'backend/conexion.php';

      $consulta="SELECT variante.id_v, variante.nombre_v, variante.ingredientes_v, variante.preparacion_v, variante.imagen_v, variante.recomendacion_v, variante.id_creador, variante.fecha_v, receta.nombre_r FROM variante INNER JOIN receta ON variante.id_receta_orig=receta.id_r;";

      $variante=mysqli_query($conexion, $consulta);

      if($variante->num_rows>0){
        while($fila=mysqli_fetch_array($variante)){
    ?>
      <tr>
        <td> <?php echo $fila['id_v'] ?> </td>
        <td> <?php echo $fila['nombre_v'] ?> </td>
        <td> <?php echo $fila['ingredientes_v'] ?> </td>
        <td> <?php echo $fila['preparacion_v'] ?> </td>
        <td> <?php echo "<img width='80' src='data:image/jpg;base64,".base64_encode($fila['imagen_v'])."'>" ?> </td>
        <td> <?php echo $fila['recomendacion_v'] ?> </td>
        <td> <?php echo $fila['nombre_r'] ?> </td>
        <td> <?php echo $fila['id_creador'] ?> </td>
        <td> <?php echo $fila['fecha_v'] ?> </td>
        <td>
            <!-- Botón Editar Receta -->
          <a class="btn btn-primary" data-bs-toggle="modal" href="#MOD-edit-v<?php echo $fila['id_v']; ?>" role="button">
            <i class="fa-solid fa-pen-to-square"></i>
          </a>
            <!-- Botón Borrar Receta -->
          <a class="btn btn-danger" data-bs-toggle="modal" href="#MOD-borrar-r<?php echo $fila['id_v']; ?>" role="button">
            <i class="fa-solid fa-trash-can"></i>
          </a>
            <!-- Inicio Modal Editar Receta -->
          <div class="modal fade" id="MOD-edit-v<?php echo $fila['id_v']; ?>" aria-hidden="true" aria-labelledby="MOD-edit-r-Label" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Editar Receta -->
                <div class="modal-header" style="background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                  <h5 class="modal-title" id="MOD-edit-r-Label">Editar Receta</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Editar Receta -->
                <div class="modal-body">
                  <section class="vh-100">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="text-black">
                            <!-- Contenedor del formulario -->
                          <div class="d-flex align-items-center h-custom-2 ms-xl-4 pt-xl-0 mt-xl-n5">
                              <!-- Inicio del formulario editar receta -->
                            <form id="form-edit-v<?php echo $fila['id_v']; ?>" action="backend/bk_accion.php" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: start;">
                                <!-- Inputs ocultos -->
                              <input type="hidden" name="id" value="<?php echo $fila['id_v']; ?>">
                              <input type="hidden" name="id_creador" value="<?php echo $fila['id_creador']; ?>">
                              <input type="hidden" name="accion" value="editar_v">
                                <!-- Editar Nombre -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto -->
                                <input type="text" class="form-control" id="nombre" value="<?php echo $fila['nombre_v'] ?>" name="nombre" required/>
                                <i class="fa-solid fa-pen-nib"></i>
                                <label class="form-label" for="form2Example18">Nombre *</label>
                              </div>
                                <!-- Editar Ingredientes -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto expandible con tamaño fijo -->
                                <textarea class="form-control" id="ingredientes" name="ingredientes" style="min-height: 160px;" required><?php echo $fila['ingredientes_v'] ?></textarea>
                                <i class="fa-solid fa-list-ol"></i>
                                <label class="form-label" for="form2Example28">Resumen *</label>
                              </div>
                                <!-- Editar Preparación -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto expandible con tamaño fijo -->
                                <textarea class="form-control" id="preparacion" name="preparacion" style="min-height: 160px;" required><?php echo $fila['preparacion_v'] ?></textarea>
                                <i class="fa-regular fa-file-lines"></i>
                                <label class="form-label" for="form2Example38">Informacion *</label>
                              </div>
                                <!-- Editar Imagen -->
                              <div class="form-outline mb-4">
                                  <!-- Input tipo file -->
                                <input type="file" id="imagen" name="archivo" class="form-control"/>
                                <i class="fa-solid fa-camera"></i>
                                <label class="form-label" for="form2Example18">Imagen *</label>
                              </div>
                                <!-- Editar Recomendariones -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto expandible con tamaño fijo -->
                                <textarea class="form-control" id="recomendacion" name="recomendacion" style="min-height: 160px;"><?php echo $fila['recomendacion_v'] ?></textarea>
                                <i class="fa-regular fa-file-lines"></i>
                                <label class="form-label" for="form2Example38">Recomendaciones</label>
                              </div>
                                
                            </form>
                              <!-- Fin del formulario editar receta -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
                  <!-- Footer Editar Receta -->
                <div class="modal-footer" style="background-color:rgb(43,43,43)">
                    <!-- Botón de Crear Receta -->
                  <input type="submit" form="form-edit-v<?php echo $fila['id_v']; ?>" class="btn btn-success" value="Guardar">
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Editar Receta -->

            <!-- Inicio Modal Borrar Receta -->
          <div class="modal fade" id="MOD-borrar-r<?php echo $fila['id_v']; ?>" aria-hidden="true" aria-labelledby="MOD-borrar-r-Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Borrar Receta -->
                <div class="modal-header" style="background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                  <h5 class="modal-title" id="MOD-borrar-r-Label">¡Advertencia!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Borrar Receta -->
                <div class="modal-body" style="text-align:center; color:#523114;">
                    <!-- Advertencia -->
                  <h3>¿Deseas eliminar el aviso <br> de forma permanente?</h3>
                    <!-- Inicio del formulario borrar receta -->
                  <form id="form-borrar-v<?php echo $fila['id_v'] ?>" action="backend/bk_accion.php" method="POST" >
                      <!-- Inputs ocultos -->
                    <input type="hidden" name="id" value="<?php echo $fila['id_v'] ?>">
                    <input type="hidden" name="accion" value="borrar_v">
                  </form>
                    <!-- Fin del formulario borrar receta -->
                </div>
                  <!-- Footer Borrar Receta -->
                <div class="modal-footer" style="background-color:rgb(43,43,43);">
                    <!-- Botón eliminar -->
                  <input type="submit" form="form-borrar-v<?php echo $fila['id_v'] ?>" class="btn btn-danger" value="Eliminar">
                    <!-- Botón cancelar -->
                  <button class="btn btn-success" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Borrar Receta -->
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