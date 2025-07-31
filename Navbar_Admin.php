  <!-- Inicio Estilos del Navbar Admin-->
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
    color: white;
    border-left: 1px solid black;
    padding-left: 4px;
  }
}
  /* Enlaces del Menú Desplegable */
.dropdown-item{
  font-family: 'Source Serif Pro', serif;
  font-size: 1.125rem;
  color: #523114;
}
</style>
<!-- Fin Estilos del Navbar Admin-->

<!-- Inicio Navbar Admin -->
<nav class="navbar navbar-expand-lg" style="background-color: #13322B; color:white;">
  <div class="container-fluid">
      <!-- Botón inicio -->
    <a class="navbar-brand" href="index.php">
        <!-- Logo de la página-->
      <img src="img/pa.png" alt="Logo" style="width:2.5rem; height:2.5rem;">
    </a>

      <!-- Botón Tipo Hamburguesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <!-- Inicio del Menú -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Inicio Opciones Administrador -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"> <!-- Botón Recetas -->
          <a class="nav-link" href="Admin_Recetas.php"><i class="fa-solid fa-clipboard"></i> Convocatorias</a>
        </li>
        <li class="nav-item"> <!--Botón Mis Recetas-->
              <a class="nav-link" href="Mis_Recetas.php">
                <i class="fa-solid fa-book"></i> Avisos
              </a>
            </li>
        <li class="nav-item"> <!-- Botón Usuarios -->
          <a class="nav-link" href="Admin_Usuarios.php"><i class="fa-solid fa-user"></i> Usuarios</a>
        </li>
        <li class="nav-item"> <!-- Botón Comentarios -->
          <a class="nav-link" href="Admin_Comentarios.php"><i class="fa-solid fa-comments"></i> Comentarios</a>
        </li>
      </ul>
        <!-- Fin Opciones Administrador -->
      <hr>

        <!-- Inicio Sección Logout -->
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item"> <!-- Botón Cerrar Sesión -->
          <a class="btn btn-danger" href="backend/bk_logout.php">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión
          </a>
        </li>
      </ul>
        <!-- Fin Sección Logout -->
    </div>
      <!-- Fin del Menú-->
  </div>
</nav>
  <!-- Fin Navbar Admin -->