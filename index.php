<?php
    // Retomar sesión activa.
session_start();
    // Se establece el número de errores repotados en 0.
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BECAS PAPANTLA</title>

    <!-- Libreria Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Libreria FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Libreria GoogleFonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <!-- Estilos Propios -->
  <link rel="stylesheet" type="text/css" href="css/estilos_inicio.css">

</head>
<body>

  <!-- Incluir Navbar -->
<?php
  include 'Navbar.php';
?>

  <!-- Inicio Sección A | Página Web -->
<section class="seccion-a">
<div >
    <div  class="texto-secc-a">
    <h1 class="btn btn-outline-light btn-floating m-1" class="text-white">BECAS PAPANTLA</h1>
</div>
    <!--p>Consulta las covocatorias que tenemos para ti<br>Navega e informate!!</p-->
    
  </div>
 
</section>
  <!-- Fin Sección A -->


<section>
    <!-- Inicio información principal-->
    <div  style="background-color: #B38E5D;" >
      <!-- Nombre & Eslogan --><br><br>
      <div  class="col-md-2 col-lg-3  mx-auto mt-3">
    <div class="eslogan-rest"   style="background-color: rgba(0, 0, 0, 0.4);    border-radius: 20px;   border: 2px solid #333;" >
    <h3 style= "color: white;" >ZONA DE PREGUNTAS Y RESPUESTAS FRECUENTES</h3><br>
      <img src="img/inv.gif" style="width:5rem; height:4rem;  border-radius: 20px;"><br>
      
      <select id="faq-select" class="container " >
  <option value="">Selecciona una pregunta frecuente</option>
  <option value="1">¿Cuál es el horario de atención?</option>
  <option value="2">¿Cómo puedo checar si ya me llego la beca?</option>
  <option value="3">¿Como puedo saber si la escuela de mi hijo aplica para el censo de Becas benito juarez?</option>
  <option value="4">¿Cuando comienzan las Fechas de incorporación?</option>
  <option value="5">¿Qué cita debo agendar si aun no he recibido mi deposito del bimestre correspondiente?</option>
  <option value="6">Si ya cuento con la tarjeta de bienestar,¿Comó puedo saber si ya tengo deposito en la tarjeta?</option>
  <option value="7">Tu tarjeta esta bloqueada y eres de las Remesas 2020 Y 2021</option>
</select>
<br>

<div  id="answer" ></div>
  
</div>

  </div>
  
    <!-- Fin información principal -->

    <!-- preguntas y respuestas-->
    
 


  <div class="secc-rest-1" style="background-color: #B38E5D;" class="cont-trad sombra">
     
 <div class="carusel-rest">
 
        <!-- Inicio Carusel Bootstrap -->
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <!-- Carusel Sección 1 -->
          <div class="carousel-item active">
            <img src="img/cit.jpg" class="d-block w-100" alt="...">
           
           
          </div>
           <!-- Carusel Sección 1 -->
           <div class="carousel-item active">
            <img src="img/cit2.jpg" class="d-block w-100" alt="...">
           
          </div>
            <!-- Carusel Sección 2 -->
          <div class="carousel-item">
            <img src="img/cit3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
        </div>
          <!-- Botones Carusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
        <!-- Fin Carusel Bootstrap -->
    </div>
  

    <!-- Fin información principal -->

    <!-- Inicio información extra -->
  
      <!-- Ubicación -->
    <div class="ubicacion-rest">
      <h3 style="font-family:'Oleo Script',cursive;">UBICACIÓN</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.5715456827584!2d-97.33502461339786!3d20.4417055033776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85da441487be4bcf%3A0x8c79dd6c965e4eb4!2sC.%20Francisco%20Villa%20%26%20Calle%20Electores%2C%20Barrio%20del%20Zapote%2C%2093486%20Papantla%20de%20Olarte%2C%20Ver.!5e0!3m2!1ses!2smx!4v1687869707930!5m2!1ses!2smx" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>      </div>
    </div>
    <div class="ubicacion-rest">
    <h3 style="font-family:'Oleo Script',cursive;">Descarga la App Banco de bienestar</h3>
    <a class="btn btn-primary" href="https://play.google.com/store/apps/details?id=gob.bancodelbienestar.bcobienapp&hl=es_MX" target="_blank"> Da click Aqui!</a><br>
    <img src="img/inf.jpg" style="width:20%; height:15%;  border-radius: 20px;"><br>
      </div>
    <!-- Fin información extra -->
</section>
  <!-- Fin Sección B -->

  <!-- Incluir Footer -->
<?php
  include 'Footer.php';
?>

  <!-- Script Bootstrap -->
  <script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>