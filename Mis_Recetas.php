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
  <title>Becas | Avisos</title>

    <!-- Libreria Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Libreria FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Libreria GoogleFonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <!-- Estilos Propios -->
  <link rel="stylesheet" type="text/css" href="css/estilos_recetario.css">

</head>
<body> <!-- <> -->

<?php
  include 'Navbar_Admin.php';
?>
  <!-- Inicio Sección Mis Recetas -->
<section class="d-flex" style="justify-content:space-between; padding:40px 10%; font-family:'Source Serif Pro';">
    <!-- Titulo -->
  <h2 style="color:#523114;">Avisos Importantes</h2>
    <!-- Botón Agregar Receta -->
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modal-AddVariante">
    <i class="fa-solid fa-plus"></i> Agregar Aviso
  </button>
    <!-- Inicio Modal Agregar Variante -->
  <div class="modal fade" id="Modal-AddVariante" aria-hidden="true" aria-labelledby="Modal-AddVariante-Label" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
          <!-- Header Modal Agregar Variante -->
        <div class="modal-header" style="background-color: #13322B; color:white;">
          <h5 class="modal-title" id="Modal-AddVariante-Label">Nueva Información</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <!-- Body Modal Agregar Variante -->
        <div class="modal-body">
          <section class="vh-100">
            <div class="container-fluid">
              <div class="row">
                <div class="text-black">
                  <div class="px-5 ms-xl-4 d-flex align-items-center">
                    <div>
                      <span class="h2 fw-bold mb-0">Ingresa la información</span>
                    </div>
                  </div>
                  <br>
                    <!-- Contenedor del formulario -->
                  <div class="d-flex align-items-center h-custom-2 ms-xl-4 pt-xl-0 mt-xl-n5">
                      <!-- Inicio del formulario agregar variante -->
                    <form id="form-add-v" action="backend/bk_reg_v.php" method="POST" enctype="multipart/form-data" style="width:100%;">
                      <input type="hidden" name="id_c" value="<?php echo $_SESSION['id']; ?>"/>
                        <!-- Ingresar Nombre -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto -->
                        <input type="text" class="form-control" id="name-form-addv" name="nombre" required/>
                        <i class="fa-solid fa-pen-nib"></i>
                        <label class="form-label" for="name-form-addv">Nombre *</label>
                      </div>
                        <!-- Ingresar Ingredientes -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto expandible con tamaño fijo -->
                        <textarea class="form-control" id="ingr-form-addv" name="ingredientes" style="min-height:160px;" required></textarea>
                        <i class="fa-solid fa-list-ol"></i>
                        <label class="form-label" for="ingr-form-addv">Cita Programada *</label>
                      </div>
                        <!-- Ingresar Modo de Preparación -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto expandible con tamaño fijo -->
                        <textarea class="form-control" id="prep-form-addv" name="preparacion" style="min-height:160px;" required></textarea>
                        <i class="fa-regular fa-file-lines"></i>
                        <label class="form-label" for="prep-form-addv">Informacion *</label>
                      </div>
                        <!-- Ingresar imagen -->
                      <div class="form-outline mb-4">
                          <!-- Input tipo archivo -->
                        <input type="file" class="form-control" id="img-form-addv" name="imagen" required/>
                        <i class="fa-solid fa-camera"></i>
                        <label class="form-label" for="img-form-addv">Imagen *</label>
                      </div>
                        <!-- Ingresar recomendaciones -->
                      <div class="form-outline mb-4">
                          <!-- Cuadro de texto expandible con tamaño fijo -->
                        <textarea class="form-control" id="reco-form-addv" name="recomendacion" style="min-height:160px;"></textarea>
                        <i class="fa-regular fa-file-lines"></i>
                        <label class="form-label" for="reco-form-addv">Recomendaciones</label>
                      </div>
                         <!-- Indicación -->
                      <h4 style="text-align:center;">Este aviso es una variante de:</h4>
                        <!-- Selección de receta original -->
                      <div class="form-outline mb-4">
                            <!-- Menú de opciones -->
                        <select class="form-control" name="seleccion">

                        <?php // Inicio inserción PHP
                          include 'backend/conexion.php';

                          $consulta_r="SELECT * FROM receta";

                          $receta=mysqli_query($conexion, $consulta_r);

                          if($receta->num_rows>0){
                            while($fila_r=mysqli_fetch_array($receta)){
                        ?> <!-- Fin inserción PHP -->

                               <!-- Opciones -->
                          <option value="<?php echo $fila_r['id_r'] ?>"><?php echo $fila_r['nombre_r'] ?></option>

                        <?php // Inicio inserción PHP
                            }
                          }
                        ?> <!-- Fin inserción PHP -->

                        </select>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
          <!-- Footer Modal Agregar Variante -->
        <div class="modal-footer"  style="background-color:rgb(43,43,43)">
            <!-- Botón de Crear Variante -->
          <input type="submit" form="form-add-v" class="btn btn-success" value="Crear" name="add-v">
        </div>
      </div>
    </div>
  </div>
    <!-- Fin Modal Agregar Variante -->
</section>
  <!-- Fin Sección Mis Recetas -->

  <!-- Inicio Sección Recetas -->
<section class="cont-trad sombra">
    <!-- Contenedor de cards -->
  <div class="recetas">
    <div class="box-container">
        
      <?php // Inicio inserción PHP
      $id=$_SESSION['id'];

        // Se crea la consulta de mySQL, tabla receta donde el nombre sea como la variable $buscar.
      $consulta_v="SELECT * FROM variante WHERE id_creador='$id'";
        // Se realiza la consulta a la base de datos.
      $variante=mysqli_query($conexion, $consulta_v);

        // Si existen variantes que cumplan con la consulta...
      if($variante->num_rows>0){
          // Se desglosan en filas los datos obtenidos de la consulta.
          // Mientras existan filas, se muestran las respectivas 'cards'. 
        while($fila_v=mysqli_fetch_array($variante)){
      ?> <!-- Fin inserción PHP -->

        <!-- Inicio de la Card -->
      <div class="box sombra">
          <!-- Imagen -->
        <div class="image">
          <a href="Info_Variantes.php?id=<?php echo $fila_v['id_v']; ?>">
            <?php echo "<img src='data:image/jpg;base64,".base64_encode($fila_v['imagen_v'])."'>" ?>
          </a>
        </div>
          <!-- Contenido -->
        <div class="content">
            <!-- Nombre -->
          <a href="Info_Variantes.php?id=<?php echo $fila_v['id_v']; ?>" class="title"><?php echo $fila_v['nombre_v']; ?></a>
            <!-- Administrar recetas -->
          <div>
              <!-- Botón Editar Receta -->
            <a class="btn btn-warning" data-bs-toggle="modal" href="#MOD-edit-v<?php echo $fila_v['id_v']; ?>" role="button">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
              <!-- Botón Borrar Receta -->
            <a class="btn btn-danger" data-bs-toggle="modal" href="#MOD-borrar-r<?php echo $fila_v['id_v']; ?>" role="button">
              <i class="fa-solid fa-trash-can"></i>
            </a>
              <!-- Inicio Modal Editar Receta -->
            <div class="modal fade" id="MOD-edit-v<?php echo $fila_v['id_v']; ?>" aria-hidden="true" aria-labelledby="MOD-edit-r-Label" tabindex="-1">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <!-- Header Editar Receta -->
                  <div class="modal-header" style="background-color: #13322B; color:white;">
                    <h5 class="modal-title" id="MOD-edit-r-Label">Editar Aviso</h5>
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
                              <form id="form-edit-v<?php echo $fila_v['id_v']; ?>" action="backend/bk_accion.php" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: start;">
                                  <!-- Inputs ocultos -->
                                <input type="hidden" name="id" value="<?php echo $fila_v['id_v']; ?>">
                                <input type="hidden" name="id_creador" value="<?php echo $fila_v['id_creador']; ?>">
                                <input type="hidden" name="accion" value="editar_v">
                                  <!-- Editar Nombre -->
                                <div class="form-outline mb-4">
                                    <!-- Cuadro de texto -->
                                  <input type="text" class="form-control" id="nombre" value="<?php echo $fila_v['nombre_v'] ?>" name="nombre" required/>
                                  <i class="fa-solid fa-pen-nib"></i>
                                  <label class="form-label" for="form2Example18">Nombre *</label>
                                </div>
                                  <!-- Editar Ingredientes -->
                                <div class="form-outline mb-4">
                                    <!-- Cuadro de texto expandible con tamaño fijo -->
                                  <textarea class="form-control" id="ingredientes" name="ingredientes" style="min-height: 160px;" required><?php echo $fila_v['ingredientes_v'] ?></textarea>
                                  <i class="fa-solid fa-list-ol"></i>
                                  <label class="form-label" for="form2Example28">Cita Programada *</label>
                                </div>
                                  <!-- Editar Preparación -->
                                <div class="form-outline mb-4">
                                    <!-- Cuadro de texto expandible con tamaño fijo -->
                                  <textarea class="form-control" id="preparacion" name="preparacion" style="min-height: 160px;" required><?php echo $fila_v['preparacion_v'] ?></textarea>
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
                                  <textarea class="form-control" id="recomendacion" name="recomendacion" style="min-height: 160px;"><?php echo $fila_v['recomendacion_v'] ?></textarea>
                                  <i class="fa-regular fa-file-lines"></i>
                                  <label class="form-label" for="form2Example38">Recomendaciones</label>
                                </div>
                                 <!-- Editar Recomendariones -->
                                <h4 style="text-align: center;">Este aviso es una variante de:</h4>
                                <div class="form-outline mb-4">
                                    <!-- Editar Variante -->
                                  <select class="form-control" name="seleccion">
                                  <?php
                                    $consulta_r="SELECT * FROM receta";

                                    $receta=mysqli_query($conexion, $consulta_r);

                                    if($receta->num_rows>0){
                                      while($fila_r=mysqli_fetch_array($receta)){
                                  ?>
                                    <option value="<?php echo $fila_r['id_r'] ?>"><?php echo $fila_r['nombre_r'] ?></option>
                                  <?php
                                      }
                                    }
                                  ?>
                                  </select>
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
                  <div class="modal-footer" style="background-color:rgb(43,43,43);">
                      <!-- Botón de Crear Receta -->
                    <input type="submit" form="form-edit-v<?php echo $fila_v['id_v']; ?>" class="btn btn-success" value="Guardar">
                  </div>
                </div>
              </div>
            </div>
              <!-- Fin Modal Editar Receta -->

              <!-- Inicio Modal Borrar Receta -->
            <div class="modal fade" id="MOD-borrar-r<?php echo $fila_v['id_v']; ?>" aria-hidden="true" aria-labelledby="MOD-borrar-r-Label" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <!-- Header Borrar Receta -->
                  <div class="modal-header" style="background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                    <h5 class="modal-title" id="MOD-borrar-r-Label">¡Advertencia!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                    <!-- Body Borrar Receta -->
                  <div class="modal-body" style="text-align: center;">
                      <!-- Advertencia -->
                    <h3>¿Deseas eliminar el aviso de forma permanente?</h3>
                      <!-- Inicio del formulario borrar receta -->
                    <form id="form-borrar-v<?php echo $fila_v['id_v']; ?>" action="backend/bk_accion.php" method="POST" >
                        <!-- Inputs ocultos -->
                      <input type="hidden" name="id" value="<?php echo $fila_v['id_v'] ?>">
                      <input type="hidden" name="accion" value="borrar_v">
                    </form>
                      <!-- Fin del formulario borrar receta -->
                  </div>
                    <!-- Footer Borrar Receta -->
                  <div class="modal-footer" style="background-color:rgb(43,43,43);">
                      <!-- Botón eliminar -->
                    <input type="submit" form="form-borrar-v<?php echo $fila_v['id_v']; ?>" class="btn btn-danger" value="Eliminar">
                      <!-- Botón cancelar -->
                    <button class="btn btn-success" type="button" data-bs-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
              <!-- Fin Modal Borrar Receta -->
          </div>
        </div>
      </div>
        <!-- Fin de la Card -->

      <?php // Inicio inserción PHP
        }
      }else{
      ?> <!-- Fin inserción PHP -->


        <h4 style="color: #523114;"><br><br>Aún no has creado una receta.<br><br></h4>

        
      <?php // Inicio inserción PHP
      }
      ?> <!-- Fin inserción PHP -->
    </div>
  </div>
  <br>
</section>
  <!-- Fin recetas tradicionales -->

<br>

<?php // Incluir el Footer
  include 'Footer.php';
?>

  <!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>