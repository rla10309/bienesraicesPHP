<?php
require "../includes/funciones.php";
$auth = estaAutenticado();

if (!$auth) {
    header("Location: /bienesraices/index.php");
}

// Importar la conexión
require "../includes/config/database.php";
$db = conectarDB();


// Escribir el query
$query = "SELECT * FROM propiedades";

// Consultar resultados
$resultadoConsulta = mysqli_query($db, $query);

// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        // Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE idpropiedades = $id";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink("../imagenes/" . $propiedad["imagen"]);



        // Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE idpropiedades = $id";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header("Location: index.php?resultado=3");
        }
    }
}

// Incluye un template

incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>
    <?php
    if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
    <?php endif ?>

    <a href="/bienesraices/admin/propiedades/crear.php" class="boton btn-verde">Nueva Propiedad</a>


    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar resultados -->
            <?php while ($propiedad = mysqli_fetch_assoc(($resultadoConsulta))) :  ?>
                <!-- <?php
                        echo "<pre>";
                        var_dump($propiedad);
                        echo "</pre>"; ?> -->

                <tr>
                    <td><?php echo $propiedad["idpropiedades"]; ?></td>
                    <td><?php echo $propiedad["titulo"]; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad["imagen"]; ?>" class="imagen-tabla"> </td>
                    <td>$<?php echo $propiedad["precio"]; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad["idpropiedades"]; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar" />
                        </form>

                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad["idpropiedades"]; ?>" class="btn-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</main>
<?php
mysqli_close($db);
incluirTemplate("footer");
?>