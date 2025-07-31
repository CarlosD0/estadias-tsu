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
  <title>Becas | Administrar info</title>

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

  <!-- Inicio Sección Admin Recetas -->
<section class="d-flex" style="justify-content:space-between; padding:40px 10%; font-family:'Source Serif Pro';">
    <!-- Titulo -->
  <h2 style="color:#446600; font-weight:bold;">ADMINISTRADOR</h2>
    <!-- Botón Agregar Receta -->
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#MOD-new-rece">
    <i class="fa-solid fa-plus"></i> Agregar nueva inf 
  </button>
    <!-- Inicio Modal Agregar Receta -->
  <div class="modal fade" id="MOD-new-rece" aria-hidden="true" aria-labelledby="MOD-new-rece-Label" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
          <!-- Header Agregar Receta -->
        <div class="modal-header" style="background-color: #13322B; color:white;">
          <h5 class="modal-title" id="MOD-new-rece-Label">CRUD</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <!-- Body Agregar Receta -->
        <div class="modal-body">
          <section class="vh-100">
            <div class="container-fluid">
              <div class="row">
                <div class="text-black">
                  <div class="px-5 ms-xl-4 d-flex align-items-center">
                    <div>
                      <span class="h2 fw-bold mb-0">AGREGAR DATOS DE CONVOCATORIA</span>
                    </div>
                  </div>
                  <br>
                    <!-- Contenedor del formulario -->
                  <div class="d-flex align-items-center h-custom-2 ms-xl-4 pt-xl-0 mt-xl-n5">
                      <!-- Inicio del formulario agregar receta -->
                    <form id="form-add-receta" action="backend/bk_reg_r.php" method="POST" enctype="multipart/form-data" style="width: 100%;">
                        <!-- Ingresar Nombre -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto -->
                        <input type="text" class="form-control" id="nombre" name="nombre" required/>
                        <i class="fa-solid fa-pen-nib"></i>
                        <label class="form-label" for="form2Example18">Nombre *</label>
                      </div>
                        <!-- Ingresar Ingredientes -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto expandible con tamaño fijo -->
                        <textarea class="form-control" id="ingredientes"  name="ingredientes" style="max-height: 160px; min-height: 160px;" required></textarea>
                        <i class="fa-solid fa-list-ol"></i>
                        <label class="form-label" for="form2Example28">Resumen</label>
                      </div>
                        <!-- Ingresar Modo de Preparación -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto expandible con tamaño fijo -->
                        <textarea class="form-control" id="preparacion" name="preparacion" style="max-height: 160px; min-height: 160px;" required></textarea>
                        <i class="fa-regular fa-file-lines"></i>
                        <label class="form-label" for="form2Example38">Informacion *</label>
                      </div>
                        <!-- Ingresar imagen -->
                      <div class="form-outline mb-4">
                          <!-- Input tipo archivo -->
                        <input type="file" class="form-control" id="imagen" name="imagen"/>
                        <i class="fa-solid fa-camera"></i>
                        <label class="form-label" for="form2Example18">Imagen *</label>
                      </div>
                        <!-- Ingresar recomendaciones -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto expandible con tamaño fijo -->
                        <textarea class="form-control" id="recomendacion" name="recomendacion" style="max-height: 160px; min-height: 160px;"></textarea>
                        <i class="fa-regular fa-file-lines"></i>
                        <label class="form-label" for="form2Example38">Ingresa el Link de la pagina Oficial:</label>
                      </div>
                    </form>
                      <!-- Fin del formulario agregar  -->
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
          <!-- Footer Agregar  -->
        <div class="modal-footer" style="background-color:#B38E5D;">
            <!-- Botón de Crear -->
          <input type="submit" form="form-add-receta" class="btn btn-success" value="Crear" name="add-r">
        </div>
      </div>
    </div>
  </div>
    <!-- Fin Modal Agregar Receta -->
</section>

  <!-- Contenedor de la tabla -->
<main class="cont-re-trad sombra" >
  <pre style="font-size: 1rem;">
    <!-- Inicio de la tabla recetas -->
  <table class="table table-responsive table-bordered border-dark" id="tabla-re" style="font-family:'Source Serif Pro';">
      <!-- Head de la tabla -->
    <thead>
        <!-- Columnas -->
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Resumen</th>
        <th scope="col">Informacion</th>
        <th scope="col">Imagen</th>
        <th scope="col">Recomendaciones</th>
        <th scope="col">Fecha</th>
        <th scope="col">Opciones</th> 
      </tr>
    </thead>
      <!-- Body de la tabla -->
    <tbody>
      <!-- Inicio inserción PHP -->
    <?php
      include 'backend/conexion.php'; // Sentencia para incluir archivo de conexión.

      $consulta="SELECT * FROM receta;"; // Se crea la consulta de mySQL, tabla receta.

      $receta=mysqli_query($conexion, $consulta); // Se realiza la consulta a la base de datos.

      if($receta->num_rows>0){ // Si existen recetas...
          // Se desglosan en filas los datos obtenidos de la consulta.
          // Mientras existan filas, se muestran las respectivas 'cards'. 
        while($fila=mysqli_fetch_array($receta)){
    ?>
      <!-- Fin inserción PHP -->

      <!-- Contenido de las filas -->
      <tr>
        <td> <?php echo $fila['id_r'] ?> </td>
        <td> <?php echo $fila['nombre_r'] ?> </td>
        <td> <?php echo $fila['ingredientes_r'] ?> </td>
        <td> <?php echo $fila['preparacion_r'] ?> </td>
        <td> <?php echo "<img width='80' src='data:image/jpg;base64,".base64_encode($fila['imagen_r'])."'>" ?> </td>
        <td> <?php echo $fila['recomendacion_r'] ?> </td>
        <td> <?php echo $fila['fecha_r'] ?> </td>
        <td>
            <!-- Botón Editar Receta -->
          <a class="btn btn-primary" data-bs-toggle="modal" href="#MOD-edit-r<?php echo $fila['id_r']; ?>" role="button">
            <i class="fa-solid fa-pen-to-square"></i>
          </a>
            <!-- Botón Borrar Receta -->
          <a class="btn btn-danger" data-bs-toggle="modal" href="#MOD-borrar-r<?php echo $fila['id_r']; ?>" role="button">
            <i class="fa-solid fa-trash-can"></i>
          </a>
            <!-- Inicio Modal Editar Receta -->
          <div class="modal fade" id="MOD-edit-r<?php echo $fila['id_r']; ?>" aria-hidden="true" aria-labelledby="MOD-edit-r-Label" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Editar Receta -->
                <div class="modal-header" style="font-family:'Source Serif Pro';" style="background-color: #13322B;">
                  <h5 class="modal-title" id="MOD-edit-r-Label">Editar Información</h5>
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
                            <form id="form-edit-r<?php echo $fila['id_r']; ?>" action="backend/bk_accion.php" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: start;">
                                <!-- Inputs ocultos -->
                              <input type="hidden" name="id" value="<?php echo $fila['id_r']; ?>">
                              <input type="hidden" name="accion" value="editar_r">
                                <!-- Editar Nombre -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto -->
                                <input type="text" class="form-control" id="nombre" value="<?php echo $fila['nombre_r']; ?>" name="nombre" required/>
                                <i class="fa-solid fa-pen-nib"></i>
                                <label class="form-label" for="form2Example18">Nombre *</label>
                              </div>
                                <!-- Editar Ingredientes -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto expandible con tamaño fijo -->
                                <textarea class="form-control" id="ingredientes" name="ingredientes" style="min-height: 160px;" required><?php echo $fila['ingredientes_r']; ?></textarea>
                                <i class="fa-solid fa-list-ol"></i>
                                <label class="form-label" for="form2Example28">Resumen *</label>
                              </div>
                                <!-- Editar Preparación -->
                              <div class="form-outline mb-4">
                                  <!-- Cuadro de texto expandible con tamaño fijo -->
                                <textarea class="form-control" id="preparacion" name="preparacion" style="min-height: 160px;" required><?php echo $fila['preparacion_r']; ?></textarea>
                                <i class="fa-regular fa-file-lines"></i>
                                <label class="form-label" for="form2Example38">Información *</label>
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
                                <textarea class="form-control" id="recomendacion" name="recomendacion" style="min-height: 160px;"><?php echo $fila['recomendacion_r']; ?></textarea>
                                <i class="fa-regular fa-file-lines"></i>
                                <label class="form-label" for="form2Example38">Ingresa el Link de la pagina Oficial:</label>
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
                  <input type="submit" form="form-edit-r<?php echo $fila['id_r']; ?>" class="btn btn-success" value="Guardar">
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Editar Receta -->
        
            <!-- Inicio Modal Borrar Receta -->
          <div class="modal fade" id="MOD-borrar-r<?php echo $fila['id_r']; ?>" aria-hidden="true" aria-labelledby="MOD-borrar-r-Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Borrar Receta -->
                <div class="modal-header" style="font-family:'Source Serif Pro'; background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                  <h5 class="modal-title" id="MOD-borrar-r-Label">¡Advertencia!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Borrar Receta -->
                <div class="modal-body" style="text-align: center; color:#523114;">
                    <!-- Advertencia -->
                  <h3>¿Deseas eliminar la Convocatoria <br> de forma permanente?</h3>
                    <!-- Inicio del formulario borrar receta -->
                  <form id="form-borrar-r<?php echo $fila['id_r'] ?>" action="backend/bk_accion.php" method="POST">
                      <!-- Inputs ocultos -->
                    <input type="hidden" name="id" value="<?php echo $fila['id_r'] ?>">
                    <input type="hidden" name="accion" value="borrar_r">
                  </form>
                    <!-- Fin del formulario borrar receta -->
                </div>
                  <!-- Footer Borrar Receta -->
                <div class="modal-footer" style="background-color:rgb(43,43,43);">
                    <!-- Botón eliminar -->
                  <input type="submit" form="form-borrar-r<?php echo $fila['id_r'] ?>" class="btn btn-danger" value="Eliminar">
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
  <!-- Fin Sección Admin Recetas -->

  <!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>