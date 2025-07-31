<?php
  // Reanuda una sesión activa.
session_start();
  // Se establece el número de errores repotados en 0.
error_reporting(0);

  // Asignar el valor de los indices 'nombre' y 'rol' en el array de la sesión a dos variables.
$id_user=$_SESSION['id'];
$nom_user=$_SESSION['nombre'];
$rol_user=$_SESSION['rol'];
?>

  <!-- Inicio Estilos del Navbar -->
<style>
  /* Enlaces del Navbar */
.nav-link{
  font-family: 'Source Serif Pro', serif;
  font-size: 1.125rem;
  color: white;
}
  /* Si la pantalla mide mínimo 992px entonces... */
@media (min-width: 992px) {
  .nav-link:hover{
    color: black;
    border-bottom: 1px solid black;
  }
}
  /* Si la pantalla mide máximo 991px entonces... */
@media (max-width: 991px) {
  .nav-link:hover{
    color: black;
    border-left: 1px solid black;
    padding-left: 4px;
  }
}
  /* Enlaces del Menú Desplegable */
.dropdown-item{
  font-family: 'Source Serif Pro', serif;
  font-size: 1.125rem;
  color: white;
}
</style>
  <!-- Fin Estilos del Navbar -->

  <!-- Inicio del Navbar con Bootstrap -->
<nav class="navbar navbar-expand-lg" style="background-color: #13322B;">
  <div class="container-fluid">
      <!-- Botón inicio -->
    <a class="navbar-brand" href="index.php">
        <!-- Logo de la página-->
      <img src="img/pa.png" alt="Logo" style="width:4rem; height:4rem;">
    </a>

      <!-- Botón Tipo Hamburguesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <!-- Inicio del Menú -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Inicio Opciones Generales -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"> <!-- Botón Recetas -->
          <a class="nav-link" href="Convocatorias.php"><i class="fa-solid fa-clipboard"></i> Convocatorias</a>
        </li>
        <li class="nav-item"> <!-- Botón Recetas -->
          <a class="nav-link" href="variante.php"><i class="fa-solid fa-calendar-days"></i> Avisos De Programas Sociales </a>
        </li>
        <li class="nav-item"> <!-- Botón comentarios -->
          <a class="nav-link" data-bs-toggle="modal" href="#Modal-Comentarios">
            <i class="fa-solid fa-comments"></i> Comentarios
          </a>
        </li>
        <li class="nav-item"> <!-- Botón Sobre Nosotros -->
          <a class="nav-link" data-bs-toggle="modal" href="#Modal-SobreNosotros">
            <i class="fa-solid fa-circle-info"></i> Sobre Nosotros
          </a>
        </li>
        
      </ul>
    
        <!-- Fin Opciones Generales -->

      <hr> <!-- Divisor -->

      <?php
        // Si, la variable $nom_user, esta vacia o contiene espacios en blanco, entonces...
      if($nom_user==null||$nom_user==""){
        // Se ocultan los botones de usuario y admin
        echo '<style> .btn-usuario, .btn-admin{display: none;}</style>';
      }else{// En cambio, si hay una sesión iniciada...
        if($rol_user==1){// Si el rol es igual a 1 (administrador)...
          // Se ocultan los botones de acceso y usuario
          echo '<style> .btn-acceso, .btn-usuario{display: none;}</style>';
        }else{// Si no, el rol es un usuario convencional, entonces...
          // Se ocultan los botones de acceso y admin
          echo '<style> .btn-acceso, .btn-admin{display: none;}</style>';
        }
      }
      ?>

        <!-- Inicio Opciones de Usuario -->
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown btn-acceso"> <!-- Botón Acceso -->
          <a class="nav-link" data-bs-toggle="modal" href="#Modal-Ingresar" role="button">
          <i class="fa-solid fa-door-open"></i>    Acceder
          </a>
        </li>
        <li class="nav-item dropdown btn-admin"> <!-- Botón Admin -->
          <a class="nav-link" href="Admin_Recetas.php" role="button">
            <i class="fa-solid fa-list-check"></i> Administrador
          </a>
        </li>
        <li class="nav-item dropdown btn-usuario"> <!-- Botón Usuario -->
          <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> <?php echo $nom_user; ?>
          </a>
            <!-- Inicio menú usuario -->
          <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="usuarioDropdown">
            
            <li> <!-- Botón Editar Cuenta -->
              <a class="dropdown-item" data-bs-toggle="modal" href="#Modal-EditarUser" role="button">
                <i class="fa-solid fa-user-pen"></i> Editar Cuenta
              </a>
            </li>
              <!-- Divisor -->
            <li><hr class="dropdown-divider"></li>
            <li> <!-- Botón Cerrar Sesión -->
              <a class="btn btn-danger" href="backend/bk_logout.php" style="margin-left:12px;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión
              </a>
            </li>
          </ul>
            <!-- Fin menú usuario -->
        </li>
      </ul>
        <!-- Fin Opciones de Usuario -->

        <!-- Inicio Modal Comentarios -->
      <div class="modal fade" id="Modal-Comentarios" aria-hidden="true" aria-labelledby="Modal-Comentarios-Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content" style="font-family:'Source Serif Pro';">
              <!-- Header Modal Comentarios -->
            <div class="modal-header" style="font-family:'Source Serif Pro';  background-color: #621132; color:white;">
              <h5 class="modal-title" id="Modal-Comentarios-Label">Comentarios</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <!-- Body Modal Comentarios -->
            <div class="modal-body" style="text-align:center; color:#523114;">
              <h3>¡Déjanos tu comentario, sugerencia o queja para mejorar nuestro sitio web!</h3>
              <br>
                <!-- Formulario de comentarios -->
              <form id="form-comentarios" action="backend/bk_reg_c.php" method="POST">
                <div class="mb-3"> <!-- Cuadro de texto -->
                  <textarea class="form-control" style="min-height:160px;" name="mensaje" required></textarea>
                  <input type="hidden" name="autor" value="<?php echo $_SESSION['id']; ?>">
                </div>
              </form>
            </div>
              <!-- Footer Modal Comentarios -->
            <div class="modal-footer" style="background-color:rgb(43,43,43)">
              <?php
                // Si, la variable $nom_user, esta vacia o contiene espacios en blanco, entonces...
              if($nom_user==null||$nom_user==""){
                echo '<h5 style="color:wheat;">Inicia sesión para enviar comentarios.</h5>';
              }else{
                echo '<input type="submit" form="form-comentarios" class="btn btn-success" value="Enviar mensaje" name="add-com">';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
        <!-- Fin Modal Comentarios -->

        <!-- Inicio Modal Sobre Nosotros -->
      <div class="modal fade" id="Modal-SobreNosotros" aria-hidden="true" aria-labelledby="Modal-SobreNosotros-Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content" style="font-family:'Source Serif Pro';">
              <!-- Header Modal Sobre Nosotros -->
            <div class="modal-header" style="font-family:'Source Serif Pro';  background-color: #621132; color:white;">
              <h5 class="modal-title" id="Modal-SobreNosotros-Label">Sobre Nosotros</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <!-- Body Modal Sobre Nosotros -->
            <div class="modal-body" style="text-align:center; color:#523114;">
                <!-- Información del equipo -->
                <!--div class="carousel-caption d-none d-md-block"-->
              <h5>Misión</h5>
              <p>Nuestra misión es contribuir a la protección del Derecho a la Educación y al desarrollo humano, disminuyendo el nivel de deserción escolar mediante el otorgamiento de Becas educativas a los niños, jóvenes y adultos que se encuentren inscritos en escuelas públicas y en una situación de vulnerabilidad.</p>
              <h5>Visión</h5>
              <p>La Secretaría de Educación Pública tiene como objetivo fortalecer una educación inclusiva, equitativa y de calidad, para que las nuevas generaciones tengan la oportunidad de desarrollar capacidades y mejorar sus condiciones de vida y que la educación deje de ser un privilegio de unos cuantos, sea un derecho efectivo de todas y todos los niños y jóvenes.</p>
           
              <br>
            </div>
              <!-- Footer Modal Sobre Nosotros -->
            <div class="modal-footer" style="background-color:rgb(43,43,43)">
              ...
            </div>
          </div>
        </div>
      </div>
        <!-- Fin Modal Sobre Nosotros -->




        <!-- Inicio Modal Login -->
      <div class="modal fade" id="Modal-Ingresar" aria-hidden="true" aria-labelledby="Modal-Ingresar-Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              <!-- Header Modal Login -->
            <div class="modal-header" style="font-family:'Source Serif Pro';  background-color: #621132; color:white;">
              <h5 class="modal-title" id="Modal-Ingresar-Label">INICIAR SESIÓN</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <!-- Body Modal Login -->
            <div class="modal-body">
              <section class="vh-60">
                <div class="container-fluid">
                  <div class="row">
                    <div class="text-black">
                        <!-- Isologo de la página web -->
                      <div class="m-auto d-flex align-items-center pt-xl-0 mt-xl-n5" style="width:60%;">
                          <!-- Logo con tamaño definido -->
                        <img src="img/Logo.png" alt="Logo" style="width:max(60px,40%);">
                          <!-- Nombre de la página Web -->
                        <div style="font-family:'Oleo Script',cursive;"> 
                          <span class="h1 fw-bold mb-0">Becas Papantla</span>
                        </div>
                      </div>
                      <br>
                        <!-- Contenedor del formulario login -->
                      <div class="d-flex align-items-center pt-xl-0 mt-xl-n5">
                          <!-- Inicio del formulario -->
                        <form class="m-auto" action="backend/bk_accion.php" method="POST" style="width:90%; font-family:'Source Serif Pro';">
                            <!-- Ingresar Correo -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="email" id="email-form-login" name="correo" class="form-control form-control-lg" required/>
                            <i class="fa-solid fa-envelope"></i>
                            <label class="form-label" for="email-form-login">Correo</label>
                          </div>
                            <!-- Ingresar Contraseña -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="password" id="pass-form-login" name="contraseña" class="form-control form-control-lg" required/>
                            <i class="fa-solid fa-lock"></i>
                            <label class="form-label" for="pass-form-login">Contraseña</label>
                          </div>
                            <!-- Input oculto, detona la acción -->
                          <input type="hidden" name="accion" value="login"/>
                            <!-- Sección botones -->
                          <div class="pt-1 d-flex align-items-center" style="flex-direction:column; justify-content:start;">
                              <!-- Botón Ingresar -->
                            <input type="submit" class="btn btn-success" value="Ingresar" name="login" />
                            <br>
                              <!-- Enlace Registrarse -->
                            <p>¿No tienes una cuenta? <a data-bs-toggle="modal" href="#Modal-Registro" role="button">Registrate aquí</a></p>
                          </div>
                        </form>
                          <!-- Fin del formulario  -->
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
              <!-- Footer Modal Login -->
            <div class="modal-footer" style="background-color:rgb(43,43,43)">
            </div>
          </div>
        </div>
      </div>
        <!-- Fin Modal Login -->

        <!-- Inicio Modal Registro -->
      <div class="modal fade" id="Modal-Registro" aria-hidden="true" aria-labelledby="Modal-Registro-Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              <!-- Header Modal Registro -->
            <div class="modal-header" style="font-family:'Source Serif Pro';  background-color: #621132; color:white;">
              <h5 class="modal-title" id="Modal-Registro-Label">REGISTRATE</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <!-- Body Modal Registro -->
            <div class="modal-body">
              <section class="vh-80">
                <div class="container-fluid">
                  <div class="row">
                    <div class="text-black">
                        <!-- Isologo de la página web -->
                      <div class="m-auto d-flex align-items-center pt-xl-0 mt-xl-n5" style="width:60%;">
                          <!-- Logo con tamaño definido -->
                        <img src="img/Logo.png" alt="Logo" style="width:max(60px,40%);">
                          <!-- Nombre de la página web -->
                        <div style="font-family:'Oleo Script',cursive;">
                          <span class="h1 fw-bold mb-0">Becas Papantla</span>
                        </div>
                      </div>
                      <br>
                        <!-- Contenedor del formulario registro -->
                      <div class="d-flex align-items-center pt-xl-0 mt-xl-n5">
                          <!-- Inicio del formulario -->
                        <form class="m-auto" action="backend/bk_reg_u.php" method="POST" style="width:90%; font-family:'Source Serif Pro';">
                            <!-- Ingresar Nombre -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="text" id="name-form-reg" name="nombre" class="form-control form-control-lg" required/>
                            <i class="fa-solid fa-user"></i>
                            <label class="form-label" for="name-form-reg">Usuario *</label>
                          </div>
                            <!-- Ingresar Correo -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="email" id="email-form-reg" name="correo" class="form-control form-control-lg" required/>
                            <i class="fa-solid fa-envelope"></i>
                            <label class="form-label" for="email-form-reg">Correo *</label>
                          </div>
                            <!-- Ingresar Contraseña -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="password" id="pass-form-reg" name="contraseña" class="form-control form-control-lg" required/>
                            <i class="fa-solid fa-lock"></i>
                            <label class="form-label" for="pass-form-reg">Contraseña *</label>
                          </div>
                            <!-- Sección botones -->
                          <div class="pt-1 d-flex align-items-center" style="flex-direction:column;">
                              <!-- Botón ingresar -->
                            <input type="submit" class="btn btn-success" value="Registrarse" name="add-user"/>
                            <br>
                              <!-- Enlace Iniciar Sesión -->
                            <p>¿Ya tienes una cuenta? <a data-bs-toggle="modal" href="#Modal-Ingresar" role="button">Inicia sesión</a></p>
                          </div>
                        </form>
                          <!-- Fin del formulario -->
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
              <!-- Footer Modal Registro -->
            <div class="modal-footer" style="background-color:rgb(43,43,43)">
            </div>
          </div>
        </div>
      </div>
        <!-- Fin Modal Registro -->

        <!-- Inicio Modal Editar Cuenta -->
      <div class="modal fade" id="Modal-EditarUser" aria-hidden="true" aria-labelledby="Modal-EditarUser-Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              <!-- Header Editar Cuenta -->
            <div class="modal-header" style="font-family:'Source Serif Pro'; background:linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#DE4828); color: black;">
              <h5 class="modal-title" id="Modal-EditarUser-Label">Editar Cuenta</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <!-- Body Editar Cuenta -->
            <div class="modal-body">
              <section class="vh-90">
                <div class="container-fluid">
                  <div class="row">
                    <div class="text-black">
                        <!-- Isologo de la página web -->
                      <div class="m-auto d-flex align-items-center pt-xl-0 mt-xl-n5" style="width:60%;">
                          <!-- Logo con tamaño definido -->
                        <img src="img/Logo.png" alt="Logo" style="width:max(60px,40%);">
                          <!-- Nombre de la página web -->
                        <div style="font-family:'Oleo Script',cursive;">
                          <span class="h1 fw-bold mb-0">Becas Papantla</span>
                        </div>
                      </div>
                      <br>
                        <!-- Contenedor del Formulario Editar Cuenta -->
                      <div class="d-flex align-items-center pt-xl-0 mt-xl-n5">
                        <?php
                          include 'backend/conexion.php';

                          $consulta="SELECT * FROM usuario WHERE id_u='$id_user'";

                          $usuario=mysqli_query($conexion, $consulta);
                          $fila=mysqli_fetch_array($usuario);
                        ?>
                          <!-- Inicio del formulario -->
                        <form class="m-auto" action="backend/bk_accion.php" method="POST" style="width:90%; font-family:'Source Serif Pro';">
                            <!-- Cambiar Nombre -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="text" id="name-form-edit" name="nombre" class="form-control form-control-lg" value="<?php echo $fila['nombre_u']; ?>" required/>
                            <i class="fa-solid fa-user"></i>
                            <label class="form-label" for="name-form-edit">Usuario *</label>
                              <!-- Inputs ocultos -->
                            <input type="hidden" name="accion" value="editar_u"/>
                            <input type="hidden" name="id" value="<?php echo $fila['id_u']; ?>"/>
                            <input type="hidden" name="rol" value="2"/>
                          </div>
                            <!-- Cambiar Correo -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="email" id="email-form-edit" name="correo" class="form-control form-control-lg" value="<?php echo $fila['correo']; ?>" required/>
                            <i class="fa-solid fa-envelope"></i>
                            <label class="form-label" for="email-form-edit">Correo *</label>
                          </div>
                            <!-- Cambiar Contraseña -->
                          <div class="form-outline mb-4">
                              <!-- Cuadro de texto -->
                            <input type="password" id="pass-form-edit" name="contraseña" class="form-control form-control-lg" value="<?php echo $fila['contraseña']; ?>" required/>
                            <i class="fa-solid fa-lock"></i>
                            <label class="form-label" for="pass-form-edit">Contraseña *</label>
                          </div>
                            <!-- Botón Guardar Cambios -->
                          <div class="pt-1 d-flex align-items-center" style="flex-direction:column;">
                            <input type="submit" class="btn btn-success" value="Guardar Cambios"/>
                          </div>
                        </form>
                          <!-- Fin del formulario -->
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </section>
            </div>
              <!-- Footer Modal Editar Cuenta -->
            <div class="modal-footer" style="background-color:rgb(43,43,43)">
            </div>
          </div>
        </div>
      </div>
        <!-- Fin Modal Editar Cuenta -->
    </div>
      <!-- Fin Opciones de la Barra-->
  </div>
</nav>
  <!-- Fin del Navbar con Bootstrap -->