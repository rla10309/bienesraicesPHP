<?php
// Importar la base de datos
require "includes/config/database.php";
$db = conectarDB();

// Consultar
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
  header("Location: /bienesraices/index.php");
}

$query = "SELECT * FROM propiedades WHERE idpropiedades = $id";
$resultado = mysqli_query($db, $query);
if (!$resultado->num_rows) {
  header("Location: /bienesraices/index.php");
}

$propiedad = mysqli_fetch_assoc($resultado);


require "includes/funciones.php";
incluirTemplate("header");
?>


<main class="contenedor seccion contenido-centrado">


  <h1><?php echo $propiedad["titulo"]; ?></h1>


  <img src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen destacada" loading="lazy" />

  <div class="resumen-propiedad">
    <p class="precio">$<?php echo $propiedad["precio"]; ?></p>
    <ul class="iconos-caracteristicas">
      <li>
        <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy" />
        <p><?php echo $propiedad["wc"]; ?></p>
      </li>
      <li>
        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" />
        <p><?php echo $propiedad["estacionamiento"]; ?></p>
      </li>
      <li>
        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorios" loading="lazy" />
        <p><?php echo $propiedad["habitaciones"]; ?></p>
      </li>
    </ul>
    <?php echo $propiedad["descripcion"]; ?>

  </div>
</main>
<?php
mysqli_close($db);
incluirTemplate("footer");
?>