<?php
    // Retomar sesión activa.
session_start();
    // Se establece el número de errores repotados en 0.
error_reporting(0);

    // Declarar una variable igual al valor del indice 'nombre' en el array de la sesión.
$validar_nom=$_SESSION['nombre'];
$validar_rol=$_SESSION['rol'];

    // Si, la variable $validar, esta vacia o contiene espacios en blanco, entonces...
if($validar_nom==null || $validar_nom==""|| $validar_rol==2 ){
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
  <title>Becas | Administrar Usuarios</title>

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
  <h2 style="color:#446600; font-weight:bold;">Usuarios</h2>
</section>

  <!-- Contenedor de la tabla -->
<main class="cont-re-trad sombra">
  <pre style="font-size: 1rem;">
  <table class="table table-responsive table-bordered border-dark" id="tabla-re" style="font-family:'Source Serif Pro';">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Contraseña</th>
        <th scope="col">Rol</th>
        <th scope="col">Fecha</th>
        <th scope="col">Opciones</th> 
      </tr>
    </thead>
    <tbody>
    <?php
      include 'backend/conexion.php';

      $consulta="SELECT usuario.id_u, usuario.nombre_u, usuario.correo, usuario.contrasena, usuario.fecha_u, usuario.rol, permisos.tipo FROM usuario INNER JOIN permisos ON usuario.rol=permisos.id_p;";

      $usuario=mysqli_query($conexion, $consulta);

      if($usuario->num_rows>0){
        while($fila=mysqli_fetch_array($usuario)){
    ?>
      <tr>
        <td> <?php echo $fila['id_u'] ?> </td>
        <td> <?php echo $fila['nombre_u'] ?> </td>
        <td> <?php echo $fila['correo'] ?> </td>
        <td> <?php echo $fila['contrasena'] ?> </td>
        <td> <?php echo $fila['tipo'] ?> </td>
        <td> <?php echo $fila['fecha_u'] ?> </td>
        <td>
            <!-- Botón Editar Usuario -->
          <a class="btn btn-primary" data-bs-toggle="modal" href="#MOD-edit-u<?php echo $fila['id_u']; ?>" role="button">
            <i class="fa-solid fa-pen-to-square"></i>
          </a>
            <!-- Botón Borrar Usuario -->
          <a class="btn btn-danger" data-bs-toggle="modal" href="#MOD-borrar-u<?php echo $fila['id_u']; ?>" role="button">
            <i class="fa-solid fa-trash-can"></i>
          </a>
            <!-- Inicio Modal Editar Usuario -->
          <div class="modal fade" id="MOD-edit-u<?php echo $fila['id_u']; ?>" aria-hidden="true" aria-labelledby="MOD-edit-userLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Editar Usuario -->
                <div class="modal-header" style="background: linear-gradient(90deg, #DE4828, #E8672A,#E8672A, #DE4828); color: black;">
                  <h5 class="modal-title" id="MOD-edit-userLabel">Editar Usuario</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Editar Usuario -->
                <div class="modal-body">
                  <section class="vh-90">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="text-black">
                            <!-- Formulario Editar Cuenta -->
                          <div class="d-flex align-items-center pt-xl-0 mt-xl-n5">
                            <form action="backend/bk_accion.php" method="POST" class="m-auto" style="width: 90%;">
                                <!-- Cambiar Nombre -->
                              <div class="form-outline mb-4">
                                <input type="hidden" name="id" value="<?php echo $fila['id_u'] ?>">
                                <input type="hidden" name="accion" value="editar_u">
                                <input type="text" id="form2Example18" name="nombre" class="form-control form-control-lg" value="<?php echo $fila['nombre_u'] ?>" required/>
                                <i class="fa-solid fa-user"></i>
                                <label class="form-label" for="form2Example18">Usuario *</label>
                              </div>
                                <!-- Cambiar Correo -->
                              <div class="form-outline mb-4">
                                <input type="email" id="form2Example28" name="correo" class="form-control form-control-lg" value="<?php echo $fila['correo'] ?>" required/>
                                <i class="fa-solid fa-envelope"></i>
                                <label class="form-label" for="form2Example28">Correo *</label>
                              </div>
                                <!-- Cambiar Contraseña -->
                              <div class="form-outline mb-4">
                                <input type="password" id="form2Example38" name="contraseña" class="form-control form-control-lg" value="<?php echo $fila['contrasena'] ?>" required/>
                                <i class="fa-solid fa-lock"></i>
                                <label class="form-label" for="form2Example38">Contraseña *</label>
                              </div>
                                <!-- Cambiar Rol -->
                              <div class="form-outline mb-4">
                                <input type="text" id="form2Example38" name="rol" class="form-control form-control-lg" value="<?php echo $fila['rol'] ?>" required/>
                                <i class="fa-solid fa-lock"></i>
                                <label class="form-label" for="form2Example38">Rol *</label>
                              </div>
                                <!-- Botón Guardar -->
                              <div class="pt-1 d-flex align-items-center" style="flex-direction: column;">
                                <input type="submit" class="btn btn-success" value="Guardar Cambios"/>
                              </div>
                            </form>
                          </div>
                          <br>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Editar Cuenta -->

            <!-- Inicio Modal Borrar Usuario -->
          <div class="modal fade" id="MOD-borrar-u<?php echo $fila['id_u']; ?>" aria-hidden="true" aria-labelledby="MOD-borrar-r-Label" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <!-- Header Borrar Usuario -->
                <div class="modal-header" style="background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color:black;">
                  <h5 class="modal-title" id="MOD-borrar-r-Label">¡Advertencia!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <!-- Body Borrar Usuario -->
                <div class="modal-body"  style="text-align:center; color:#523114;">
                  <h3>¿Deseas eliminar el usuario <br> de forma permanente?</h3>
                  <form id="form-borrar-u<?php echo $fila['id_u'] ?>" action="backend/bk_accion.php" method="POST" >
                    <input type="hidden" name="id" value="<?php echo $fila['id_u'] ?>">
                    <input type="hidden" name="accion" value="borrar_u">
                  </form>
                </div>
                  <!-- Footer Borrar Usuario -->
                <div class="modal-footer" style="background-color:rgb(43,43,43);">
                  <input type="submit" form="form-borrar-u<?php echo $fila['id_u'] ?>" class="btn btn-danger" value="Eliminar">
                  <button class="btn btn-success" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </div>
          </div>
            <!-- Fin Modal Borrar Usuario -->
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