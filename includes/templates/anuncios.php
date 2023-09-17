<?php
// Importar la base de datos
require __DIR__ . "/../config/database.php";
$url = __DIR__;
$db = conectarDB();

// Consultar
$query = "SELECT * FROM propiedades LIMIT  $limite";
$resultado = mysqli_query($db, $query);

// Leer los resultados

?>

<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
        <!-- <?php
                echo "<pre>";
                echo var_dump($propiedad);
                echo "</pre>";
                ?> -->



        <div class="anuncio">
            <picture>

                <img src="imagenes/<?php echo $propiedad["imagen"] ?>" alt="Anuncio 1" loading="lazy" />
            </picture>
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad["titulo"] ?></h3>
                <p>
                    <?php echo $propiedad["descripcion"] ?>
                </p>
                <p class="precio">$<?php echo $propiedad["precio"] ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy" />
                        <p><?php echo $propiedad["wc"] ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" />
                        <p><?php echo $propiedad["estacionamiento"] ?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorios" loading="lazy" />
                        <p><?php echo $propiedad["habitaciones"] ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad["idpropiedades"] ?>" class="btn-amarillo-block">Ver Propiedad</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php
// Cerrar la conexión
mysqli_close($db);
?>