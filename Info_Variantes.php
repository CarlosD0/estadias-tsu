<?php
include 'backend/conexion.php';

$id=$_GET['id'];

$consulta="SELECT * FROM variante WHERE id_v=$id";
$consulta="SELECT variante.nombre_v, variante.ingredientes_v, 
variante.preparacion_v, variante.imagen_v, variante.recomendacion_v, 
variante.id_receta_orig, variante.fecha_v, receta.nombre_r FROM variante 
INNER JOIN receta ON variante.id_receta_orig=receta.id_r WHERE id_v=$id;";
$resultado=mysqli_query($conexion,$consulta);
$fila_fragm=mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Becas | adicional</title>

    <!-- Libreria Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Libreria FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Libreria GoogleFonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <!-- Estilos Propios -->
  <link rel="stylesheet" type="text/css" href="css/estilos_info_re.css">

</head>
<body> <!-- <> -->

<?php
  include 'Navbar.php';
?>

<section class="secc-nom-ingr">
  <div class="img-nom-re">
    <?php echo "<img src='data:image/jpg;base64,".base64_encode($fila_fragm['imagen_v'])."'>" ?>
    <div class="text-re">
      <!--h1><!?php echo $fila_fragm['nombre_v'] ?></h1-->
    </div>
  </div>
  <div style="padding: 5% 20%; font-family: 'Source Serif Pro',serif;">
    <h3 style="text-align: center; color: #446600;">Cita Programada</h3>
    <hr size="5px">
    <pre style="font-family: 'Source Serif Pro',serif; font-size: 1rem;"><?php echo $fila_fragm['ingredientes_v'] ?></pre>
  </div>
</section>

<main style="background: linear-gradient(90deg,#DE4828,#E8672A,#E8672A,#E8672A,#DE4828); padding: 30px 0px;">
  <div class="cont-re-trad sombra">
    <h3 style="text-align: center;">Informacion</h3>
    <p><?php echo $fila_fragm['preparacion_v'] ?></p>
    <hr size="5px">
    <h3 style="text-align: center;">Recomendaciones</h3>
    <?php echo $fila_fragm['recomendacion_v'] ?></p>
    <hr size="5px">
    <p class="fecha">Subido: <?php echo $fila_fragm['fecha_v'] ?></p>
  </div>
  <br>
  
</main>

<?php
  include 'Footer.php';
?>

  <!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>