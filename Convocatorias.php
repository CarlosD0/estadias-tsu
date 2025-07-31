<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mas información</title>

    <!-- Libreria Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Libreria FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Libreria GoogleFonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <!-- Estilos Propios -->
  <link rel="stylesheet" type="text/css" href="css/estilos_recetario.css">

</head>
<body>

<?php // Incluir el Navbar
  include 'Navbar.php';
?>

  <!-- Inicio sección del banner -->
<main class="seccion-banner">
    <!-- Contenedor Eslogan -->
  <div class="secc-eslogan">
  <div class="carousel-caption d-none d-md-block">
    <!--p>Informate de las nuevas convocatorias que tenemos para ti.</p-->
  </div>
</main>
  <!-- Fin sección del banner -->

  <!-- Buscador de Bootstrap -->
<div class="container-fluid buscador">
  <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <!-- Cuadro de Texto Tipo Search -->
    <input class="form-control me-2" type="search" placeholder="Buscar información" name="busqueda">
      <!-- Botón Buscar -->
    <input class="btn btn-success" type="submit" name="buscar">
  </form>
</div>

  <!-- Inicio Sección Recetas -->
<main>
    <!-- Inicio Recetas tradicionales -->
  <section class="cont-trad sombra">
      <!-- Titulo -->
    <h3>CONVOCATORIAS ACTUALES</h3>
      <!-- Contenedor de cards -->
    <div class="recetas">
	    <div class="box-container">
          
        <?php // Inicio inserción PHP
        include 'backend/conexion.php'; // Sentencia para incluir archivo de conexión.

        if(isset($_POST['buscar'])){  // Si se activa el botón 'buscar'...
          $buscar=$_POST['busqueda'].'%'; // Se le asigna el valor de la busqueda a una variable.
        }else{  // De otro modo...
          $buscar='%'; // La variable $buscar se queda indicada con un signo %.
        }

          // Se crea la consulta de mySQL, tabla receta donde el nombre sea como la variable $buscar.
        $consulta_r="SELECT * FROM receta WHERE nombre_r LIKE '$buscar'";
          // Se realiza la consulta a la base de datos.
        $receta=mysqli_query($conexion, $consulta_r);

          // Si existen recetas que cumplan con la consulta...
        if($receta->num_rows>0){
            // Se desglosan en filas los datos obtenidos de la consulta.
            // Mientras existan filas, se muestran las respectivas 'cards'. 
          while($fila_r=mysqli_fetch_array($receta)){
        ?> <!-- Fin inserción PHP -->

        	<!-- Inicio de la Card -->
        <div class="box sombra">
            <!-- Imagen -->
          <div class="image">
            <a href="Info_Resumen.php?id=<?php echo $fila_r['id_r']; ?>">
              <?php echo "<img src='data:image/jpg;base64,".base64_encode($fila_r['imagen_r'])."'>" ?>
            </a>
          </div>
            <!-- Contenido -->
          <div class="content">
              <!-- Nombre -->
            <a href="Info_Resumen.php?id=<?php echo $fila_r['id_r']; ?>" class="title"><?php echo $fila_r['nombre_r']; ?></a>
              <!-- Usuario -->
            <span><i class="fa-solid fa-house-user"></i> Becas Papantla</span>
              <!-- Descripción -->
            <p><?php echo $fila_r['preparacion_r']; ?></p>
          </div>
        </div>
        	<!-- Fin de la Card -->

        <?php // Inicio inserción PHP
          }
        }else{
        ?> <!-- Fin inserción PHP -->

          <h4 style="color: #523114;">No se encontraron Convocatorias con la descripción: <?php echo $_POST['busqueda']; ?></h4>
        
        <?php // Inicio inserción PHP
        }
        ?> <!-- Fin inserción PHP -->

      </div>
    </div>
    <br>
  </section>
    <!-- Fin recetas tradicionales -->


   
</main>
  <!-- Fin Sección Recetas -->

<?php // Incluir el Footer
  include 'Footer.php';
?>

  <!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>